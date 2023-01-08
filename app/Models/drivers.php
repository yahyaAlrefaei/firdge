<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drivers extends Model
{
    use HasFactory;

    protected $table = 'drivers';

    protected $fillable = [
        'name',
        "phone",
        "card_id",
        "car_number"
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $common = [
            'name'    => "required|unique:drivers,name,$id",
            'phone' => 'required',
            "card_id" => 'required',
            "car_number" => "required"
        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [
            'name'    => 'required|max:255|unique:drivers',
        ]);
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */

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
