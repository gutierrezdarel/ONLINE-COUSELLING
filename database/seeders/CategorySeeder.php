<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('categories')->insert([
            'category'  =>  'Personal/Social',
            'description'   =>  'Guide school counseling programs to provide the foundation for personal and social growth as students progress through school and into adulthood.',
            'icon'  =>  'fas fa-users',
        ]);

        DB::table('categories')->insert([
            'category'  =>  'Academic',
            'description'   =>  "Guide school counseling programs to implement strategies and activities to support and maximize each student's ability to learn.",
            'icon'  =>  'fas fa-graduation-cap',
        ]);

        DB::table('categories')->insert([
            'category'  =>  'Career',
            'description'   =>  'Guide school counseling programs to provide the foundation for the acquisition of skills, attitudes, and knowledge that enable students to make a successful transition from school to the world of work and from job to job across the life span.',
            'icon'  =>  'fas fa-briefcase',
        ]);
    }
}
