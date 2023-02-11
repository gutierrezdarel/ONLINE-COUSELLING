<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Section;

class RoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $roles = Role::all();
        foreach($users as $user){
            $randomRole = rand(1,4);
            foreach($roles as $role){
                if($randomRole <= $role->id){
                    DB::table('role_users')->insert([
                        'role_id'  =>  $role->id,
                        'user_id'   =>  $user->id,
                    ]);
                }
                if($randomRole == 4){
                    $user->update([
                        'section_id'    =>  Section::inRandomOrder()->first()->id,
                    ]);
                }
            }
           
        }
    }
}
