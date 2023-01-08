<?php

namespace App\Http\Controllers;

use App\Models\processe;
use App\Models\season;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $allSeason = season::all();
        $season = season::get()->pluck('seasonName')->toArray();
        $seasonDetails = [];
        $sacks_number =[];
        foreach ($allSeason as $k => $v ){
            $p = processe::where('season_id', $v['id'])->get()->pluck('number_kilo')->toArray();
            if($p){
                $seasonDetails[] = array_sum($p);
            }else {
                $seasonDetails[] = 0;
            }
        }
        foreach ($allSeason as $k => $v ){
            $p = processe::where('season_id', $v['id'])->get()->pluck('sacks_number')->toArray();
            if($p){
                $sacks_number[] = array_sum($p);
            }else {
                $sacks_number[] = 0;
            }
        }

        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($season)
            ->datasets([
                [
                    "label" => __('app.number_kilo'),
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $seasonDetails,
                ],
                [
                    "label" => __('app.sacks_number'),
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $sacks_number,
                ],
            ])
            ->options([]);

        return view('admin.dashboard.index'  , compact('chartjs'));
    }
}
