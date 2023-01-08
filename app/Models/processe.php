<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class processe extends Model
{
    use HasFactory;
    protected $table = 'processes';
    protected $fillable = [
        "client_id",
        "floor_id",
        "warehouse_id",
        "number_kilo",
        "product_id",
        "product_type_id",
        "sacks_type_id",
        "sacks_number",
        "process_type",
        "date",
        "notes",
        "is_full_exit",
        "car_number",
        "driver_name",
        "driver_number",
        "season_id",
        "sacks_color",
        "driver_id"
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id=null)
    {
        return [
            'client_id' => 'required',
            'floor_id' => 'required',
            'warehouse_id' => 'required',
            'number_kilo' => 'required',
            'product_id' => 'required',
            'product_type_id' => 'required',
            'sacks_type_id' => 'required',
            'sacks_number' => 'required',
            'process_type' => 'required',
            'date' => 'required',
            "car_number"  => 'required',
            "driver_name"  => 'required',
            "driver_number"  => 'required',
            "season_id"  => 'required',
            "sacks_color" => 'required'
        ];

    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
        public function clientRelation (){
            return $this->belongsTo(Client::class , 'client_id');
        }
        public function productRelation (){
            return $this->belongsTo(productsType::class , 'product_id');
        }
        public function typeRelation (){
            return $this->belongsTo(types::class , 'product_type_id');
        }
        public function sacksRelation (){
            return $this->belongsTo(sacks::class , 'sacks_type_id');
        }
        public function floorRelation (){
            return $this->belongsTo(floor::class , 'floor_id');
        }
        public function warehouseRelation (){
            return $this->belongsTo(warehouse::class , 'warehouse_id');
        }


        public function seasonRelation(){
            return $this->belongsTo(season::class,'season_id');
        }
    /*
    |------------------------------------------------------------------------------------
    | Scopes
    |------------------------------------------------------------------------------------
    */

    /*
    |------------------------------------------------------------------------------------
    | Attributes
    |------------------------------------------------------------------------------------
    */
}
