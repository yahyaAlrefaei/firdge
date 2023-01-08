<?php

namespace App\Http\Controllers;

use App\Models\processe;
use App\Models\productsType;
use App\Models\types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class productsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsType = productsType::all();
        return response()->json(['success' => true , 'productsType' => $productsType]);
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
            'productName' => 'required|unique:products_type,productName'
        ],[
            'productName.required' => "اسم المنتج مطلوب",
            'productName.unique' => "الاسم موجود من قبل "
        ]);

        if(count($validator->errors()) > 0){
            return redirect()->route(ADMIN . '.initialization.index')->withErrors( $validator->messages());
        }

        $product = productsType::create($request->all());
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
    public function update(Request $request)
    {
        $validator = validator::make($request->all() , [
            'productName' => 'required|unique:products_type,productName,'.$request['id'],
            'id'         => 'required'
        ],[
            'productName.required' => "اسم المنتج مطلوب",
            'productName.unique' => "الاسم موجود من قبل "
        ]);

        if(count($validator->errors()) > 0){
            return redirect()->route(ADMIN . '.initialization.index')->withErrors( $validator->messages());
        }

        $product = productsType::find($request['id']);
        $product->update(['productName' => $request['productName']]);
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

        $process = processe::where('product_id' , $id)->first();
        $type =types::where('product_id' , $id )->first();
        if($process){
            return redirect()->route(ADMIN . '.initialization.index')->withErrors( __('app.It is not possible to scan, there are processes associated with it'));
        }else if ($type){
            return redirect()->route(ADMIN . '.initialization.index')->withErrors( __('app.It is not possible to scan, there are processes associated with it'));
        }else {
            productsType::destroy($id);
            return back()->withSuccess(trans('app.success_destroy'));
        }

    }
}
