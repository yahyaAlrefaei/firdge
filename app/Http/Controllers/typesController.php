<?php

namespace App\Http\Controllers;

use App\Models\processe;
use App\Models\types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class typesController extends Controller
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
            'type' => 'required|unique:types,type',
            "product" => 'required'
        ],[
            'type.required' => "اسم المنتج مطلوب",
            'type.unique' => "الاسم موجود من قبل ",
            'product.required'    => 'المنتج مطلوب'
        ]);

        if(count($validator->errors()) > 0){
            return redirect()->route(ADMIN . '.initialization.index')->withErrors( $validator->messages());
        }

        $type = types::create([
            'product_id' => $request['product'],
            'type'    => $request['type']
        ]);
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


    public function getTypeByProduct($id){
        $type = types::where('product_id' , $id)
            ->get();
        return response()->json(['success' => true , 'type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = validator::make($request->all() , [
            'type' => 'required|unique:types,type,'.$request['id'],
            "product" => 'required'
        ],[
            'type.required' => "اسم المنتج مطلوب",
            'type.unique' => "الاسم موجود من قبل ",
            'product.required'    => 'المنتج مطلوب'
        ]);

        if(count($validator->errors()) > 0){
            return redirect()->route(ADMIN . '.initialization.index')->withErrors( $validator->messages());
        }

        $type = types::find($request['id']);
        $type->update([
            'product_id' => $request['product'],
            'type'    => $request['type']
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

        $process = processe::where('product_type_id' , $id)->first();
        if($process){
            return redirect()->route(ADMIN . '.initialization.index')->withErrors( __('app.It is not possible to scan, there are processes associated with it'));
        }else {
            types::destroy($id);
            return back()->withSuccess(trans('app.success_destroy'));
        }

    }
}
