<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'clients';

    protected $fillable = [
        'name', 'phone', 'phone2', 'companyName', 'address', 'ID_card_number', 'user_id', 'allow_login'
    ];





    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {


        $common = [
            'name'    => "required|unique:clients,name,$id",
            'phone' => 'required|min:11|max:11',
            'phone2' => 'nullable|min:11|max:11',
            'address' => 'required',
            'ID_card_number' => 'required'
        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [
            'name'    => 'required|max:255|unique:clients',
        ]);
    }


    public function advances()
    {
        return $this->hasMany(Advance::class);
    }
    public function stock()
    {
        return $this->hasMany(stock::class);
    }

    public function processes()
    {
        return $this->hasMany(processe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
