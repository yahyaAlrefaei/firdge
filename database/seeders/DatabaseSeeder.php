<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //        $this->call(users::class);
        $this->call(settingSeeder::class);
        $this->call(adminSeeder::class);
        $this->call(SmsTemplateSeeder::class);

        //        if (config('variables.WITH_FAKER')) {
        //            // FAKE data
        //        }
    }
}
