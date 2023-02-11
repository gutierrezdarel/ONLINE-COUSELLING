<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('about_titles')->insert([
            'title'  =>  'About',
            'desc'   =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem necessitatibus rerum hic dolorem perspiciatis, ea sed illum repellendus nisi ex.'
        ]);
    }
}
