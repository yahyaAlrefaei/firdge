<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\drivers;
use Illuminate\Http\Request;

class driverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = drivers::all();
        return view('admin.drivers.index' , compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, drivers::rules());

        $data = $request->all();

        drivers::create($data);

        return back()->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDriver($id)
    {
        $drivers = drivers::find($id);

        return response()->json(['success' => true ,'drivers'=>$drivers]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = drivers::findOrFail($id);

        return view('admin.drivers.edit', compact('item'));
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
        $this->validate($request, drivers::rules(true, $id));

        $item = drivers::findOrFail($id);

        $data = $request->all();


        $item->update($data);

        return redirect()->route(ADMIN . '.drivers.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        drivers::destroy($id);

        return back()->withSuccess(trans('app.success_destroy'));
    }
}
