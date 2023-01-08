<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\floor;
use App\Models\productsType;
use App\Models\sacks;
use App\Models\season;
use App\Models\types;
use App\Models\warehouse;
use Illuminate\Http\Request;

class initializationController extends Controller
{
    public function index()
    {
        $floors = floor::all();
        $warehouse = warehouse::with('floorRelation')->get();
        $sacks = sacks::all();
        $types = types::with('productRelation')->get();
        $productsType = productsType::all();
        $seasons = season::all();

        return view('admin.initialization.index', compact('seasons' , 'warehouse','floors','productsType','types','sacks'));
    }
}
