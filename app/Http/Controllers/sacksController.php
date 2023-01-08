<?php

namespace App\Http\Controllers;

use App\Models\processe;
use App\Models\sacks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class sacksController extends Controller
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
                'sacksName' => 'required|unique:sacks,sacksName',
            ],[
                'sacksName.required' => "الاسم لنوع الشيكاره مطلوب",
                'sacksName.unique' => "الاسم موجود من قبل ",

            ]);

        if(count($validator->errors()) > 0){
            return redirect()->route(ADMIN . '.initialization.index')->withErrors( $validator->messages());
        }

        $type = sacks::create([
            'sacksName' => $request['sacksName'],
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
            'sacksName' => 'required|unique:sacks,sacksName,'.$request['id'],
        ],[
            'sacksName.required' => "الاسم لنوع الشيكاره مطلوب",
            'sacksName.unique' => "الاسم موجود من قبل ",

        ]);

        if(count($validator->errors()) > 0){

            return redirect()->route(ADMIN . '.initialization.index')->withErrors( $validator->messages());
        }

        $type = sacks::find($request['id']);
        $type->update([
            'sacksName' => $request['sacksName'],
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
        $process = processe::where('sacks_type_id' , $id)->first();
        if($process){
            return redirect()->route(ADMIN . '.initialization.index')->withErrors( __('app.It is not possible to scan, there are processes associated with it'));
        }else {
            sacks::destroy($id);
            return back()->withSuccess(trans('app.success_destroy'));
        }


    }
}
