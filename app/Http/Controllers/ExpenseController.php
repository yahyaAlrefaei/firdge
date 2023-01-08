<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\setting;
use Illuminate\Http\Request;
use PDF;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('admin.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Expense::rules(), [], [
            'type' => __('app.expense-type'),
            'amount' => __('app.amount'),
            'date' => __('app.date'),
        ]);

        $data = $request->all();

        Expense::create($data);

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
    public function edit($id)
    {
        $item = Expense::findOrFail($id);

        return view('admin.expenses.edit', compact('item'));
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
        $this->validate($request, Expense::rules(true, $id));

        $item = Expense::findOrFail($id);

        $data = $request->all();


        $item->update($data);

        return redirect()->route(ADMIN . '.expenses.index')->withSuccess(trans('app.success_update'));
    }

    public function exportAllToPdf()
    {
        $data = [];
        $name = time() . "_all_expenses.pdf";
        $data['expenses'] =  Expense::get();
        $data['logo'] = setting::where(['key' => 'logo'])->first();
        $pdf = PDF::loadView('admin.expenses.export_pdf', $data);
        return $pdf->stream($name);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::destroy($id);

        return back()->withSuccess(trans('app.success_destroy'));
    }
}
