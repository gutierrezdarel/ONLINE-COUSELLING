<?php

namespace Database\Seeders;

use App\Models\Common;
use Illuminate\Database\Seeder;

class CommonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Common::factory()->create();
    }
}
