<?php

namespace Database\Seeders;

use App\Models\Vision;
use Illuminate\Database\Seeder;

class VisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vision::factory()->create();
    }
}
