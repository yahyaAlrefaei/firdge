<?php

namespace App\Http\Controllers;

use App\Models\floor;
use App\Models\productsType;
use App\Models\sacks;
use App\Models\season;
use App\Models\setting;
use App\Models\types;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class settingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting  = setting::all();
        $items = $setting->flatMap(function ($item) {
            return [$item->key  => $item->value];
        });
        return view('admin.setting.create', compact('items'));
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
        $validator = validator::make($request->all(), [
            'company_name'  => 'min:3|max:15'
        ]);

        if (count($validator->errors()) > 0) {
            return redirect()->route(ADMIN . '.setting.index')->withErrors($validator->messages());
        }

        $setting = $request->all();

        if (isset($setting['logo'])) {
            $setting['logo'] =  move_file($setting['logo'], 'logo');
        }

        if (isset($setting['background_image'])) {
            $setting['background_image'] =  move_file($setting['background_image'], 'background_images');
        }



        foreach ($setting as $key => $value) {

            if ($key != 'oldLogo' && $key != '_token') {
                $setting = setting::where('key', $key)->first();
                $setting->update(['value' => $value]);
            }
        }
        return  redirect()->route(ADMIN . '.setting.index')->withSuccess(trans('app.success_store'));
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
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
