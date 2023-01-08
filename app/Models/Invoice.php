<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        "client_id",
        "season_id",
        "total_amount",
        "paid_amount",
        "amount",
        "remained_amount",
        "percent_discount",
        "fixed_discount",
        "ton_price",
        "date",
        "notes",
        "picked_by"
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        return [
            "client_id" => "required|numeric",
            "season_id" => "required|numeric",
            "ton_price" => "required|numeric",
            "total_amount" => "required|numeric",
        ];
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function season()
    {
        return $this->belongsTo(season::class);
    }
    public function pickedBy()
    {
        return $this->belongsTo(User::class, 'picked_by');
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

    public function getDiscountAttribute()
    {
        $discount = 0;
        $remained = $this->remained_amount;
        if ($this->fixed_discount != null || $this->percent_discount != null) {
            
            if($this->percent_discount != null) {
                $discount = $this->fixed_discount + ($remained *  $this->percent_discount / 100);
            }else {
                $discount = $this->fixed_discount;
            }
        }
        return $discount;
    }
}
