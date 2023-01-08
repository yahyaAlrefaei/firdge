<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\floor;
use App\Models\sacks;
use App\Models\stock;
use App\Models\types;
use App\Models\Client;
use App\Models\season;
use App\Models\drivers;
use App\Models\setting;
use App\Models\processe;
// use Barryvdh\DomPDF\PDF;
use App\Http\helperTrait;
use App\Models\warehouse;
use App\Models\SmsTemplate;
use Illuminate\Support\Str;
use App\Models\productsType;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\transaction_history;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Support\Facades\Response;

class processesController extends Controller
{
    use helperTrait;

    private $smsService;
    public function __construct()
    {
        $this->smsService = new SmsService();
    }
    /**
     * Display a listing of the resource.
     *تم توريد/استلام 100 شيكارة من البطاطس تاريخ العملية :
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = processe::with('seasonRelation', 'productRelation', 'typeRelation', 'sacksRelation', 'clientRelation', 'floorRelation', 'warehouseRelation')
            ->latest('updated_at')->get();
        return view('admin.processes.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drivers = drivers::all();
        $floor = floor::all();
        $warehouse = warehouse::all();
        $clients  = Client::all();
        $products  =  productsType::all();
        $types  =  types::all();
        $sacks_type  =  sacks::all();
        $seasons    = season::latest()->get(['id', 'seasonName']);
        return view('admin.processes.create', compact('drivers', 'seasons', 'floor', 'warehouse', 'clients', 'products', 'types', 'sacks_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, processe::rules(), [
            "client_id.required"   => "ادخال العميل مطلوب",
            'floor_id.required' => 'ادخال الدور مطلوب',
            'warehouse_id.required'  => 'ادخال العنبر مطلوب ',
            'number_kilo.required'  => 'عدد الاطنان مطلوب',
            'product_id.required'  => 'المنتج مطلوب',
            'product_type_id.required'  => 'نوع المنتج مطلوب',
            'sacks_type_id.required'  => 'نوع  الشيكاره مطلوب',
            'sacks_number.required'  => 'عدد الشكاير مطلوب',
            'process_type.required'  => 'نوع العمليه مطلوب',
            'date.required'  => 'التاريخ مطلوب',
            "car_number.required"    => "رقم العربيه مطلوب ",
            "driver_name.required"    => "اسم السائق مطلوب ",
            "driver_number.required"    => "رقم السائق مطلوب ",
            "season_id.required"    => "الموسم مطلوب"
        ]);

        $data = $request->all();
        if ($request['process_type'] == 'exit') {
            return $this->exitData($data);
        } else if ($request['process_type'] == 'insert') {

            $this->insertData($data);
            return redirect()->route("admin.processes.index")->withSuccess(trans('app.success_store'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $floor = floor::all();
        $warehouse = warehouse::all();
        $clients  = Client::all();
        $products  =  productsType::all();
        $types  =  types::all();
        $sacks_type  =  sacks::all();
        $stock   = stock::where('process_id', $id)->first();
        $item = processe::find($id);
        $seasons = season::all();

        $item['sacks_number']  = $stock['sacks_number'];
        $item['number_tons']   =  $stock['number_tons'];
        return view('admin.processes.edit', compact('seasons', 'item', 'floor', 'warehouse', 'clients', 'products', 'types', 'sacks_type'));
    }
    public function getProcessById($id)
    {
        $floor = floor::all();
        $warehouse = warehouse::all();
        $clients  = Client::all();
        $products  =  productsType::all();
        $types  =  types::all();
        $sacks_type  =  sacks::all();
        $stock   = stock::where('process_id', $id)->first();
        $item = processe::find($id);
        $seasons = season::all();

        $item['sacks_number']  = $stock['sacks_number'];
        $item['number_tons']   =  $stock['number_tons'];
        return view('admin.processes.exit', compact('seasons', 'item', 'floor', 'warehouse', 'clients', 'products', 'types', 'sacks_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, processe::rules(true, $id));
        $data = $request->all();

        $item = processe::findOrFail($id);
        $item->update($data);
        return redirect()->route(ADMIN . '.processes.index')->withSuccess(trans('app.success_update'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        processe::destroy($id);

        return back()->withSuccess(trans('app.success_destroy'));
    }


    private function insertData($data)
    {
        // if found same data to the same client
        $oldData = stock::where([
            ["client_id", "=", $data['client_id']],
            ["product_id", "=", $data['product_id']],
            ["product_type_id", "=", $data['product_type_id']],
        ])->first();

        if ($oldData) {
            $newNumber = $oldData['number_kilo'] + $data['number_kilo'];
            $sacks_number = $oldData['sacks_number'] +  $data['sacks_number'];
            $oldData->update([
                'number_kilo' => $newNumber,
                'sacks_number' => $sacks_number
            ]);
        } else {
            stock::create($data);
        }
        $process = processe::create($data);
        $this->saveHistory([
            'action'       => $data['process_type'],
            'number_kilo'  => $data['number_kilo'],
            'sacks_number' => $data['sacks_number']
        ]);
        // dd( $this->processCreatedThenSendSmsMs($process));
        return $process;
    }

    public function checkClientAvailableStock(Request $request)
    {
        if ($request->process_type == "exit") {
            $stock = stock::where(['client_id' => $request->client_id, 'product_id' => $request->product_id, 'product_type_id' => $request->product_type_id])->first();
            if (isset($stock)) {
                return response()->json([
                    'success' => true,
                    'stock' => $stock->number_kilo,
                    'sacks' => $stock->sacks_number,
                    'remained_weight' =>  $request->number_kilo - $stock->number_kilo,
                    'exceeded_wight' => $request->number_kilo > $stock->number_kilo ? true : false,
                    'exceeded_sacks' => $request->sacks_number > $stock->sacks_number ? true : false
                ]);
            }
        }
    }
    private  function exitData($data)
    {

        $storeData = stock::where([
            ["client_id", "=", $data['client_id']],
            ["product_id", "=", $data['product_id']],
            ["product_type_id", "=", $data['product_type_id']]
        ])->first();

        if ($storeData) {
            if (
                $data['sacks_number'] > $storeData['sacks_number']

            ) {
                return back()->withErrors(trans('app.Quantity is not available for extraction for this customer'));
            } else {
                if (
                    $data['sacks_number'] < $storeData['sacks_number']
                ) {

                    $newNumber = $storeData['number_kilo'] - $data['number_kilo'];
                    $sacks_number = $storeData['sacks_number'] - $data['sacks_number'];
                    $storeData->update([
                        'number_kilo' => $newNumber,
                        'sacks_number' => $sacks_number
                    ]);
                    $this->saveHistory([
                        'action'       => $data['process_type'],
                        'number_kilo'  => $data['number_kilo'],
                        'sacks_number' => $data['sacks_number']
                    ]);
                    $process = processe::create($data);
                    //send sms
                    return $this->processCreatedThenSendSmsMsg($process);
                } else if (
                    $data['sacks_number'] == $storeData['sacks_number']
                ) {
                    // $storeData->delete();
                    $newNumber = $storeData['number_kilo'] - $data['number_kilo'];
                    $sacks_number = $storeData['sacks_number'] - $data['sacks_number'];
                    $storeData->update([
                        'number_kilo' => $newNumber,
                        'sacks_number' => $sacks_number
                    ]);

                    $this->saveHistory([
                        'action'       => $data['process_type'],
                        'number_kilo'  => $data['number_kilo'],
                        'sacks_number' => $data['sacks_number']
                    ]);
                    $process = processe::create($data);
                    return $this->processCreatedThenSendSmsMsg($process);
                }
            }
        } else {
            return back()->withErrors(trans('app.not data found for this client it may have been extracted before'));
        }
    }

    public function exportProcessToPdf(processe $process)
    {
        $data = [];
        $name = time() . "_process.pdf";
        $data['process'] = processe::with('seasonRelation', 'productRelation', 'typeRelation', 'sacksRelation', 'clientRelation', 'floorRelation', 'warehouseRelation')->first();
        // $data['logo'] = setting::where(['key' => 'logo'])->first();
        // return view('admin.processes.invoice', $data);
        $pdf = PDF::loadView('admin.processes.invoice', $data);
        return $pdf->stream($name);
    }

    public function exportAllToPdf()
    {
        $data = [];
        $name = time() . "_process.pdf";
        $data['processes'] = processe::with('seasonRelation', 'productRelation', 'typeRelation', 'sacksRelation', 'clientRelation', 'floorRelation', 'warehouseRelation')->get();
        $data['logo'] = setting::where(['key' => 'logo'])->first();
        // return view('admin.processes.export_pdf', $data);
        $pdf = PDF::loadView('admin.processes.export_pdf', $data);
        return $pdf->stream($name);
    }

    /**
     * change the placeholder of the template based on the process type
     *
     * @param processe $process
     *
     * @return string
     */
    private function updateTheTemplateMsg($process)
    {
        if ($process->process_type == "insert") {
            $sms_template = SmsTemplate::where('subject', "process_insert")->first();
            if (isset($sms_template)) {
                $new_msg = $sms_template->body;
                $new_msg = str_replace("{{sacks_number}}", $process->sacks_number, $new_msg);
                $new_msg = str_replace("{{product_type}}", $process->typeRelation->type, $new_msg);
                $new_msg = str_replace("{{killo}}", $process->number_kilo, $new_msg);


                return $new_msg;
            } else {
                $new_msg = "تم توريد {$process->sacks_number} شيكارة من {$process->typeRelation->type} بوزن {$process->number_kilo}";
                return $new_msg;
            }
        } else if ($process->process_type == "exit") {
            $sms_template = SmsTemplate::where('subject', "process_exit")->first();
            if (isset($sms_template)) {
                $new_msg = $sms_template->body;
                $new_msg = str_replace("{{sacks_number}}", $process->sacks_number, $new_msg);
                $new_msg = str_replace("{{product_type}}", $process->productRelation->productName, $new_msg);
                $new_msg = str_replace("{{killo}}", $process->number_kilo, $new_msg);

                return $new_msg;
            } else {
                $new_msg = "تم تسليم {$process->sacks_number} شيكارة من {$process->typeRelation->type} بوزن {$process->number_kilo}";
                return $new_msg;
            }
        }
    }

    /**
     * finalizer to send msg to client and redirect back
     *
     * @param processe $process
     *
     * @return void
     */
    private function processCreatedThenSendSmsMsg($process)
    {
        if ($process->clientRelation->phone) {
            $response = $this->smsService->sendSmsMsg($process->clientRelation->phone, $this->updateTheTemplateMsg($process));
        }
        if ($response == "success") {
            return back()->withSuccess(trans('app.sms_message_sent'));
        } else {
            return back()->withSuccess(trans('app.sms_message_failed'));
        }
        // return back()->withSuccess(trans('app.success_store'));
        return back();
    }
}
