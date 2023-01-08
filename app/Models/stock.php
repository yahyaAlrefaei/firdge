<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class stock extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'stock';
    protected $fillable = [
        "client_id",
        "number_kilo",
        "product_id",
        "product_type_id",
        "sacks_number",
        "season_id"
    ];


    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        return [
            "client_id" => "required",
            "number_kilo" => "required",
            "product_id" => "required",
            "product_type_id" => "required",
            "sacks_number" => "required",
        ];
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */





    public function season()
    {
        return $this->belongsTo(season::class);
    }
    public function clientRelation()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function productRelation()
    {
        return $this->belongsTo(productsType::class, 'product_id');
    }

    public function typeRelation()
    {
        return $this->belongsTo(types::class, 'product_type_id');
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
