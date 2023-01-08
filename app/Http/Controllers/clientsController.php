<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advance;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\processe;
use App\Models\productsType;
use App\Models\season;
use App\Models\setting;
use App\Models\stock;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;
use PDF;

class clientsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SmsService $smsService)
    {
        $items = Client::latest('updated_at')->get();

        return view('admin.clients.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Client::rules(), [], [
            'ID_card_number' => __("app.ID_card_number")
        ]);

        $data = $request->all();

        if ($request->filled('create_as_user')) {
            //create user 
            //check allow for status
            $this->validate($request, [
                'phone' => 'required|unique:users,name',
                'password' => "required|min:6"
            ]);

            $user = User::create([
                'name' => $request->phone,
                'email' => $request->phone,
                'password' => bcrypt($request->password),
                'role' => 2,
                'status' => $request->filled('allow_login') ? "active" : "inactive"
            ]);
            $data['user_id'] =  $user->id;
            $data['allow_login'] = $request->filled('allow_login');
        }

        $client = Client::create($data);

        return back()->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $season_id = $request->get('season_id');
        $stock = stock::where('client_id', $id)
            ->when($season_id, function ($instance) use ($request) {
                $instance->where('season_id', $request->get('season_id'));
            })->with(['productRelation', 'typeRelation'])
            ->get();

        $seasons = season::all(['id', 'seasonName', 'ton_price']);
        if (request()->ajax()) {
            return Datatables::of($stock)
                ->addIndexColumn()
                ->rawColumns(['index'])
                ->make(true);
        }

        $client = Client::find($id);
        $client->load('user');
        return view('admin.clients.profile', compact('client', 'stock', 'seasons'));
    }



    public function exportClientProcesses(Client $client)
    {
        $data = [];
        $name = time() . "_process.pdf";
        $data['processes'] = processe::with('seasonRelation', 'productRelation', 'typeRelation', 'sacksRelation', 'clientRelation', 'floorRelation', 'warehouseRelation')->where('client_id', $client->id)->get();
        $data['client'] = $client;
        $data['logo'] = setting::where(['key' => 'logo'])->first();
        // return view('admin.clients.export_processes_pdf', $data);
        $pdf = PDF::loadView('admin.clients.export_processes_pdf', $data);
        return $pdf->stream($name);
    }

    public function exportClientStock(Client $client)
    {
        $data = [];
        $name = time() . "_stock.pdf";
        $data['stocks'] =  stock::where('client_id', $client->id)->with(['productRelation', 'typeRelation', 'season'])->get();
        $data['client'] = $client;
        $data['logo'] = setting::where(['key' => 'logo'])->first();
        // return view('admin.clients.export_stock_pdf', $data);
        $pdf = PDF::loadView('admin.clients.export_stock_pdf', $data);
        return $pdf->stream($name);
    }

    public function exportClientAdvances(Client $client)
    {
        $data = [];
        $name = time() . "_advances.pdf";
        $data['advances'] =  Advance::where('client_id', $client->id)->with(['season'])->get();
        $data['client'] = $client;
        $data['logo'] = setting::where(['key' => 'logo'])->first();
        // return view('admin.clients.export_advances_pdf', $data);
        $pdf = PDF::loadView('admin.clients.export_advances_pdf', $data);
        return $pdf->stream($name);
    }

    public function exportClientFinances(Client $client)
    {
        $id = $client->id;

        $season = season::with(['processes' => function ($q) use ($id) {
            $q->where('client_id', $id)->where('process_type', "insert");
        }, 'advances' => function ($q) use ($id) {
            $q->where('client_id', $id);
        }, "stock" => function ($q) use ($id) {
            $q->where('client_id', $id);
        }])->get();

        $new_data = $season->map(function ($q) use ($id) {
            $q->total_kgs = $q->processes->sum('number_kilo');
            $q->total_sacks = $q->processes->sum('sacks_number');
            $q->kgs_in_stock = $q->stock->sum('number_kilo');
            $q->sacks_in_stock = $q->stock->sum('sacks_number');
            $q->paid_amount = $q->advances->sum('amount');
            $q->total_amount = $q->total_kgs * $q->ton_price / 1000;
            $q->remained_amount = $q->total_amount - $q->paid_amount;

            return $q;
        });
        $data = [];
        $name = time() . "_finances.pdf";
        $data['finances'] =  $new_data;
        $data['client'] = $client;
        $data['logo'] = setting::where(['key' => 'logo'])->first();
        // return view('admin.clients.export_finances_pdf', $data);
        $pdf = PDF::loadView('admin.clients.export_finances_pdf', $data);
        return $pdf->stream($name);
    }
    /**
     * return datatable of client advances.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function displayClientAdvances(Request $request, $id)
    {
        // $data = DB::table('processes')
        //     ->where('processes.client_id', $id)
        //     ->leftJoin('advances', 'processes.client_id', '=', 'advances.client_id')
        //     ->leftJoin('stock', 'processes.client_id', '=', 'stock.client_id')
        //     ->leftJoin('season', 'processes.season_id', '=', 'season.id')
        //     ->select(
        //         DB::raw('sum(processes.number_kilo) as total_kgs'),
        //         DB::raw('sum(processes.sacks_number) as total_sacks'),
        //         DB::raw('sum(stock.sacks_number) as sacks_in_stock'),
        //         DB::raw('sum(stock.number_kilo) as kgs_in_stock'),
        //         DB::raw("season.seasonName as season_name"),
        //         "season.id as season_id",
        //         "season.ton_price as ton_price",
        //     )->groupBy("season_name", "season_id", "ton_price")
        //     ->get();


        // $new_data = $data->map(function ($q) use ($id) {
        //     if ($q->season_id) {
        //         $q->paid_amount = Advance::where([
        //             'season_id' => $q->season_id,
        //             'client_id' => $id
        //         ])->sum('amount');

        //         $q->total_amount = $q->total_kgs * $q->ton_price / 1000;
        //         $q->remained_amount = $q->total_amount - $q->paid_amount;

        //         return $q;
        //     }
        // });

        $data = season::with(['processes' => function ($q) use ($id) {
            $q->where('client_id', $id)->where('process_type', "insert");
        }, 'advances' => function ($q) use ($id) {
            $q->where('client_id', $id);
        }, "stock" => function ($q) use ($id) {
            $q->where('client_id', $id);
        }])->get();

        $new_data = $data->map(function ($q) use ($id) {
            $q->total_kgs = $q->processes->sum('number_kilo');
            $q->total_sacks = $q->processes->sum('sacks_number');
            $q->kgs_in_stock = $q->stock->sum('number_kilo');
            $q->sacks_in_stock = $q->stock->sum('sacks_number');
            $q->paid_amount = $q->advances->sum('amount');
            $q->total_amount = $q->total_kgs * $q->ton_price / 1000;
            $q->remained_amount = $q->total_amount - $q->paid_amount;

            return $q;
        });

        if (request()->ajax()) {
            return Datatables::of($new_data)
                ->addIndexColumn()
                ->rawColumns(['index'])
                ->make(true);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Client::findOrFail($id);

        return view('admin.clients.edit', compact('item'));
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
        $this->validate($request, Client::rules(true, $id));

        $item = Client::findOrFail($id);

        $data = $request->all();


        $item->update($data);

        return redirect()->route(ADMIN . '.clients.index')->withSuccess(trans('app.success_update'));
    }

    public function sendSmsMessageToClient(Request $request, SmsService $smsService)
    {
        $this->validate($request, [
            'message' => 'required',
            'client_id' => 'required'
        ], [
            'message.required' => 'نص الرسالة مطلوب',
            'client_id.required' => 'حدث خطأ ما الرجاء المحاولة مرة اخرى'
        ]);


        $client = Client::find($request->client_id);
        if (isset($client)) {
            $response = $smsService->sendSmsMsg($client->phone, $request->message);
            if ($response == SmsService::RETURN_SUCCESS) {
                return back()->withSuccess(trans('app.msg_send_success'));
            } else {
                return back()->withErrors(trans('app.msg_send_fail'));
            }
        } else {
            return back()->withSuccess(trans('app.msg_send_fail'));
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $process = processe::where('client_id', $id)->first();
        if ($process) {
            return redirect()->route(ADMIN . '.setting.index')->withErrors(__('app.It is not possible to scan, there are processes associated with it'));
        } else {
            Client::destroy($id);

            return back()->withSuccess(trans('app.success_destroy'));
        }
    }
}
