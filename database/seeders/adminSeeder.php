<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $data = [
            'name' => 'elmansey',
            'email' => 'test@gmail.com',
            'password' => bcrypt('123456789'),
            'status' => 'active',
            'role'   => 1
        ];
        $setting = DB::table('users')->insert($data);
    }
}
