<?php

namespace Database\Seeders;

use App\Models\InquiryReceiver;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class InquiryReceiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inquiry_receivers')->insert([
            'email' => 'ub.online.counseling@gmail.com',
        ]);
    }
}
