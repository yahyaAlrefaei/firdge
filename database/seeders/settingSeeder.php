<?php

namespace Database\Seeders;

use App\Models\setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class settingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->delete();
        $data = [
            ['key' => 'company_name', 'value' => null],
            ['key' => 'owner_name', 'value' => null],
            ['key' => 'email', 'value' => null],
            ['key' => 'phone', 'value' => null],
            ['key' => 'desc', 'value' => ''],
            ['key' => 'other_phone', 'value' => null],
            ['key' => 'location', 'value' => null],
            ['key' => 'logo', 'value' => null],
            ['key' => 'background_image', 'value' => null],
        ];

        $setting = DB::table('setting')->insert($data);
    }
}
