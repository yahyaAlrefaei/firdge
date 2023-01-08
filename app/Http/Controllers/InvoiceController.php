<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advance;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\processe;
use App\Models\season;
use App\Models\setting;
use Illuminate\Http\Request;
use DataTables;
use stdClass;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with('season', 'client:id,name', 'pickedBy:id,name')->get();

        if (request()->ajax()) {
            return Datatables::of($invoices)
                ->addIndexColumn()
                ->addColumn('actions', function ($query) {
                    return view('admin.invoices.btn')->with("id", $query->id);
                })
                ->rawColumns(['index', 'actions'])
                ->make(true);
        }

        return view('admin.invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seasons    = season::latest()->get(['id', 'seasonName']);
        $clients = Client::all(['id', 'name']);

        if (request()->ajax()) {
            if (request()->get('client_id') && request()->get('season_id')) {
                $advances = Advance::where('client_id', '=', request()->get('client_id'))
                    ->where('season_id', '=', request()->get('season_id'))
                    ->with('season', 'pickedBy')->get();
                return Datatables::of($advances)
                    ->addIndexColumn()
                    ->rawColumns(['index'])
                    ->make(true);
            }
        }

        return view('admin.invoices.create', compact('seasons', 'clients'));
    }

    public function getFiniacialStatusOfClient(Request $request)
    {
        $client_id = $request->client_id;
        $season_id = $request->season_id;

        //get sum of all inserted process
        $processes_total_inserted_kgs = processe::where([
            'process_type' => 'insert',
            'season_id' => $season_id,
            'client_id' => $client_id
        ])->sum('number_kilo');

        $season = season::find($season_id);

        $paid_amount = Advance::where([
            'season_id' => $season_id,
            'client_id' => $client_id
        ])->sum('amount');

        //total_required_amount
        $total_required = ($processes_total_inserted_kgs / 1000) * $season->ton_price;
        //paid_amount 
        $remained_amount = $total_required - $paid_amount;

        return response()->json([
            "success" => true,
            'total_required' => $total_required,
            'paid_amount' => $paid_amount,
            'remained_amount' => $remained_amount,
            "ton_price" => $season->ton_price,
            "total_tons" => $processes_total_inserted_kgs / 1000
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Invoice::rules());
        $data = $request->only(['client_id', 'season_id', 'amount', 'total_amount', 'paid_amount', 'remained_amount', 'date', 'notes', 'percent_discount', 'fixed_discount', 'ton_price']);
        if ($request->amount != null && $request->amount > 0) {
            //create new advance
            //increase paid_amount
            //decrease remained_amount
            $data_for_new_advance = $request->only(['client_id', 'season_id', 'amount', 'date']);
            $data_for_new_advance['picked_by'] = auth()->id();
            $advance = Advance::create($data_for_new_advance);
            $data['total_amount'] = $request->total_amount;
            $data['paid_amount'] = $request->paid_amount + $request->amount;
            $data['remained_amount'] = $request->total_amount - $data['paid_amount'];
        }

        if (($request->percent_discount != null && $request->percent_discount > 0)
            || ($request->fixed_discount != null && $request->fixed_discount > 0)
        ) {
            //reduce total amount required
            //decrease remained_amount
            $old_remained = $data['remained_amount'];
            $new_remained = ($old_remained - $request->fixed_discount) / (1 + ($request->percent_discount / 100));
            $data['remained_amount'] = $new_remained;
        }

        is_null($request->fixed_discount) ? $data['fixed_discount'] = 0.00 : "";
        is_null($request->total_amount) ? $data['total_amount'] = 0.00 : "";
        is_null($request->paid_amount) ? $data['paid_amount'] = 0.00 : "";
        is_null($request->remained_amount) ? $data['remained_amount'] = 0.00 : "";
        is_null($request->amount) ? $data['amount'] = 0.00 : "";

        $data['picked_by'] = auth()->id();

        $invoice = Invoice::create($data);
        return redirect()->route('admin.invoices.index')->withSuccess(trans('app.success_store'));
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
    public function edit(Invoice $invoice)
    {
        $seasons    = season::latest()->get(['id', 'seasonName']);
        $clients = Client::all(['id', 'name']);

        if (request()->ajax()) {
            if (request()->get('client_id') && request()->get('season_id')) {
                $advances = Advance::where('client_id', '=', request()->get('client_id'))
                    ->where('season_id', '=', request()->get('season_id'))
                    ->with('season', 'pickedBy')->get();
                return Datatables::of($advances)
                    ->addIndexColumn()
                    ->rawColumns(['index'])
                    ->make(true);
            }
        }

        return view('admin.invoices.create', compact('seasons', 'clients', 'invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $this->validate($request, Invoice::rules());
        $data = $request->only(['client_id', 'season_id', 'amount', 'total_amount', 'paid_amount', 'remained_amount', 'date', 'notes', 'percent_discount', 'fixed_discount', 'ton_price']);
        if ($request->amount != null && $request->amount > 0) {
            if ($invoice->amount > 0) {
                $data_for_new_advance = $request->only(['client_id', 'season_id', 'date']);
                $data_for_new_advance['picked_by'] = auth()->id();
                $data_for_new_advance['amount'] = $request->amount - $invoice->amount;
                $advance = Advance::create($data_for_new_advance);
                $data['total_amount'] = $request->total_amount;
                $data['paid_amount'] = $request->paid_amount + $data_for_new_advance['amount'];
                $data['remained_amount'] = $request->total_amount - $data['paid_amount'];
            } else {
                $data_for_new_advance = $request->only(['client_id', 'season_id', 'amount', 'date']);
                $data_for_new_advance['picked_by'] = auth()->id();
                $advance = Advance::create($data_for_new_advance);
                $data['total_amount'] = $request->total_amount;
                $data['paid_amount'] = $request->paid_amount + $request->amount;
                $data['remained_amount'] = $request->total_amount - $data['paid_amount'];
            }
        }

        if (($request->percent_discount != null && $request->percent_discount > 0)
            || ($request->fixed_discount != null && $request->fixed_discount > 0)
        ) {
            //reduce total amount required
            //decrease remained_amount
            $old_remained = $data['remained_amount'];
            $new_remained = ($old_remained - $request->fixed_discount) / (1 + ($request->percent_discount / 100));
            $data['remained_amount'] = $new_remained;
        }
        $data['picked_by'] = auth()->id();

        is_null($request->fixed_discount) ? $data['fixed_discount'] = 0.00 : "";
        is_null($request->total_amount) ? $data['total_amount'] = 0.00 : "";
        is_null($request->paid_amount) ? $data['paid_amount'] = 0.00 : "";
        is_null($request->remained_amount) ? $data['remained_amount'] = 0.00 : "";
        is_null($request->amount) ? $data['amount'] = 0.00 : "";
        $invoice = $invoice->update($data);
        return redirect()->route('admin.invoices.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('admin.invoices.index')->withSuccess(trans('app.success_destroy'));
    }

    public function exportInvoiceToPdf(Invoice $invoice)
    {
        // $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp']);

        // $mpdf = new \Mpdf\Mpdf([
        //     'mode'        => 'utf-8',
        //     'format'      => 'A4',
        //     'orientation' => 'P',
        // ]);

        // $mpdf->autoScriptToLang         = true;
        // $mpdf->autoLangToFont           = true;
        // $mpdf->allow_charset_conversion = false;
        /** Dom Pdf */
        $data = [];
        $name = time() . "_Invoice.pdf";
        $data['invoice'] = $invoice->load('client', 'season', 'pickedBy');
        $data['logo'] = setting::where(['key' => 'logo'])->first();
        $data['advances'] = Advance::where(['client_id' => $invoice->client_id])->get();


        // $mpdf->WriteHTML(view('admin.invoices.invoice', $data));

        // $mpdf->Output('deposits_report_' . time() . '.pdf', 'D');

        $pdf = PDF::loadView('admin.invoices.invoice', $data);
        return $pdf->stream($name);
    }
}
