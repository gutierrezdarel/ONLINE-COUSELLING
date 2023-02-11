<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role'  =>  'Super-Admin',
        ]);

        DB::table('roles')->insert([
            'role'  =>  'Admin',
        ]);

        DB::table('roles')->insert([
            'role'  =>  'Guidance',
        ]);
        
        DB::table('roles')->insert([
            'role'  =>  'Student',
        ]);
    }
}
