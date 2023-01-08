<?php

namespace Database\Seeders;

use App\Models\SmsTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmsTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $sms = SmsTemplate::create([
        "subject" => "process_insert",
        "body" => "تم توريد {{sacks_number}} شيكارة من {{product_type}} بوزن {{killo}} كيلو"
       ]);

       $sms = SmsTemplate::create([
        "subject" => "process_exit",
        "body" => "تم تسليم {{sacks_number}} شيكارة من {{product_type}} بوزن {{killo}} كيلو"
       ]);

       $sms = SmsTemplate::create([
        "subject" => "new_advance",
        "body" => "تم توريد مبلغ {{amount}} من حسابكم "
       ]);


    }
}
