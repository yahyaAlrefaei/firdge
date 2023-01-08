<?php

namespace App\Http\Controllers;

use App\Models\processe;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class warehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $validator = validator::make($request->all() , [
                'warehouseName' => 'required|unique:warehouses,warehouseName',
                'floor_id' => "required"
            ],[
                'warehouseName.required' => "اسم العنبر مطلوب",
                'warehouseName.unique' => "الاسم موجود من قبل ",
                "floor_id" => 'اسم الدور مطلوب'
            ]);

        if(count($validator->errors()) > 0){
            return redirect()->route(ADMIN . '.initialization.index')->withErrors( $validator->messages());
        }

        $product = warehouse::create($request->all());
        return redirect()->route(ADMIN . '.initialization.index')->withSuccess(trans('app.added successfully'));

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function warehouseRelatedFloor($id){
        $warehouse = warehouse::where('floor_id' , $id)
            ->get();
        return response()->json(['success' => true , 'warehouse' => $warehouse]);
    }
    public function update(Request $request)
    {
        $validator = validator::make($request->all() , [
            'warehouseName' => 'required|unique:warehouses,warehouseName,'.$request['id'],
            'floor_id' => "required"
        ],[
            'warehouseName.required' => "اسم العنبر مطلوب",
            'warehouseName.unique' => "الاسم موجود من قبل ",
            "floor_id" => 'اسم الدور مطلوب'
        ]);

        if(count($validator->errors()) > 0){
            return redirect()->route(ADMIN . '.initialization.index')->withErrors( $validator->messages());
        }

        $warehouse = warehouse::find($request['id']);
        $warehouse->update([
            'floor_id' => $request['floor_id'],
            'warehouseName' => $request['warehouseName']
        ]);
        return redirect()->route(ADMIN . '.initialization.index')->withSuccess(trans('app.update successfully'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $process = processe::where('warehouse_id' , $id)->first();
        if($process){
            return redirect()->route(ADMIN . '.initialization.index')->withErrors( __('app.It is not possible to scan, there are processes associated with it'));
        }else {
            warehouse::destroy($id);
            return back()->withSuccess(trans('app.success_destroy'));
        }

    }
}
