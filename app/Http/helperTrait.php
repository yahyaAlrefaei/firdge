<?php
namespace App\Http;
use App\Models\history;
use App\Models\transaction_history;
use Carbon\Carbon;
use http\Env\Response;

trait helperTrait {

    public function saveHistory($data){
        $history = history::create([
           'user_id'  => auth()->user()->id,
           'action'  => $data['action'],
            "number_kilo" => $data['number_kilo'] ,
            "sacks_number" => $data['sacks_number'] ,
           'date'  => Carbon::now()->toDateString(),
        ]);
    }
}
