<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_titles')->insert([
            'title'  =>  'Services',
            'description'   =>  'Many students encounter problems or feelings that are not easily resolvable, and sometimes the usual ways of handling them may not be working effectively. Students sometimes find that talking to friends or relatives about their concerns is not very helpful as these individuals are either unsure what to say, or are not objective or patient enough to understand and join with them through the process, or they seem to have their own agenda instead.'
        ]);
    }
}
