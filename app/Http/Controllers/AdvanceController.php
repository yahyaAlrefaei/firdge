<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advance;
use App\Models\Client;
use App\Models\season;
use App\Models\setting;
use App\Models\SmsTemplate;
use App\Services\SmsService;
use Illuminate\Http\Request;
use DataTables;
use PDF;

class AdvanceController extends Controller
{
    private $smsService;
    public function __construct()
    {
        $this->smsService = new SmsService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //season-client-amount-date-picked_by
        $advances = Advance::with('season', 'client:id,name', 'pickedBy:id,name')->get();

        if (request()->ajax()) {
            return Datatables::of($advances)
                ->addIndexColumn()
                ->addColumn('actions', function ($query) {
                    return view('admin.advances.btn')->with("id", $query->id);
                })
                ->rawColumns(['index', 'actions'])
                ->make(true);
        }

        return view('admin.advances.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all(['id', 'name']);
        $seasons = season::all(['id', 'seasonName']);


        return view('admin.advances.create', compact('clients', 'seasons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Advance::rules());

        $data = $request->only(['client_id', 'season_id', 'amount', 'date', 'notes']);
        $data['picked_by'] = auth()->id();
        $advance = Advance::create($data);
        return $this->SendSmsMsgToClient($advance);
        return back()->withSuccess(trans('app.success_store'));
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
    public function edit(Advance $advance)
    {
        $clients = Client::all(['id', 'name']);
        $seasons = season::all(['id', 'seasonName']);


        return view('admin.advances.create', compact('clients', 'seasons', 'advance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advance $advance)
    {
        $this->validate($request, Advance::rules());

        $data = $request->only(['client_id', 'season_id', 'amount', 'date', 'notes']);
        $data['picked_by'] = auth()->id();
        $advance = $advance->update($data);
        return back()->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advance $advance)
    {
        $advance->delete();
        return back()->withSuccess(trans('app.success_destroy'));
    }


    public function exportAllToPdf()
    {
        $data = [];
        $name = time() . "_all_advances.pdf";
        $data['advances'] =  Advance::with(['season', 'client'])->get();
        $data['logo'] = setting::where(['key' => 'logo'])->first();
        $pdf = PDF::loadView('admin.advances.export_advances_pdf', $data);
        return $pdf->stream($name);
    }
    /**
     * change the placeholder of the template 
     * 
     * @param Advance $advance
     * 
     * @return string
     */
    private function updateTheTemplateMsg($advance)
    {
        $sms_template = SmsTemplate::where('subject', "new_advance")->first();
        if (isset($sms_template)) {
            $new_msg = $sms_template->body;
            $new_msg = str_replace("{{amount}}", $advance->amount, $new_msg);
            return $new_msg;
        } else {
            $new_msg = "تم توريد مبلغ $advance->amount من حسابكم ";
            return $new_msg;
        }
    }

    /**
     * finalizer to send msg to client and redirect back
     * 
     * @param Advance $advance
     * 
     * @return void
     */
    private function SendSmsMsgToClient($advance)
    {
        if ($advance->client->phone) {
            $response = $this->smsService->sendSmsMsg($advance->client->phone, $this->updateTheTemplateMsg($advance));
        }
        if ($response == SmsService::RETURN_SUCCESS) {
            return back()->withSuccess(trans('app.sms_message_sent'));
        } else {
            return back()->withSuccess(trans('app.sms_message_failed'));
        }
        return back()->withSuccess(trans('app.success_store'));
    }
}
