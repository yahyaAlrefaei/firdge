<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;

    protected $fillable = [
        "client_id",
        "season_id",
        "amount",
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
            "amount" => "required|numeric",
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
}
