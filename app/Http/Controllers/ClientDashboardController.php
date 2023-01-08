<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advance;
use App\Models\Client;
use App\Models\processe;
use App\Models\stock;
use Illuminate\Http\Request;
use DataTables;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $client = Client::where('user_id', auth()->id())->first();
        return view('client.dashboard', compact('client'));
    }

    public function getProcessesOfClient($id)
    {
        $items = processe::with('seasonRelation', 'productRelation', 'typeRelation', 'sacksRelation', 'clientRelation', 'floorRelation', 'warehouseRelation')->where('client_id', '=', $id)
            ->latest('updated_at')->get();

        if (request()->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('process_type_d', function ($query) {
                    if ($query->process_type == 'insert') {
                        return '<span class="badge badge-primary">' . __('app.' . $query->process_type) . '</span>';
                    } else if ($query->process_type == 'exit') {
                        return '<span class="badge badge-dark">' . __('app.' . $query->process_type) . '</span>';
                    }
                })
                ->rawColumns(['index', 'process_type_d'])
                ->make(true);
        }
    }
    public function getAdvancesOfClient($id)
    {
        $advances = Advance::where('client_id' ,$id)->with('season')->get();

        if (request()->ajax()) {
            return Datatables::of($advances)
                ->addIndexColumn()
                ->rawColumns(['index'])
                ->make(true);
        }
    }
    public function getStockOfClient($id)
    {
        $advances = stock::where('client_id' ,$id)->with('productRelation' , 'typeRelation' , 'season')->get();

        if (request()->ajax()) {
            return Datatables::of($advances)
                ->addIndexColumn()
                ->rawColumns(['index'])
                ->make(true);
        }
    }
}
