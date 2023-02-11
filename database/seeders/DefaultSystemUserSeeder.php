<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class DefaultSystemUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => 'Super Admin',
            'status' =>  1,
            'section_id' => 0,
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar'    =>  'noimage.jpg',
            'last_login'    =>  null,
            'remember_token' => Str::random(10),
        ]);


        DB::table('users')->insert([
            'name' => 'Admin',
            'status'    =>  1,
            'section_id' => 0,
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'last_login'    =>  null,
            'avatar'    =>  'noimage.jpg',
            'remember_token' => Str::random(10),
        ]);

       

        DB::table('users')->insert([
            'name' => 'Giselle Ann E. Manansala',
            'status' =>  1,
            'section_id' => 0,
            'email' => 'giselleann.enriquez@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar'    =>  'noimage.jpg',
            'last_login'    =>  null,
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'Rjay Casanova',
            'status' =>  1,
            'section_id' => 0,
            'email' => 'rjay.casanova@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar'    =>  'noimage.jpg',
            'last_login'    =>  null,
            'remember_token' => Str::random(10),
        ]);


        DB::table('users')->insert([
            'name' => 'Juan dela Cruz',
            'status' =>  1,
            'email' => 'juan@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar'    =>  'noimage.jpg',
            'last_login'    =>  null,
            'section_id' => 3,
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'Bernard Dalisay',
            'status' =>  1,
            'email' => 'bernard@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar'    =>  'noimage.jpg',
            'last_login'    =>  null,
            'section_id' => 1,
            'remember_token' => Str::random(10),
        ]);

        


        
        $superAdmin = User::where('email','superadmin@gmail.com')->first();
        $giselle = User::where('email','giselleann.enriquez@gmail.com')->first();
        $rjay = User::where('email','rjay.casanova@gmail.com')->first();
        $admin = User::where('email','admin@gmail.com')->first();
        $juan = User::where('email','juan@gmail.com')->first();
        $bernard = User::where('email','bernard@gmail.com')->first();
      
      

        $roles = Role::all();

        foreach($roles as $role){

            //Insert role of role of Default Super Admin
           
            $roleUser = new RoleUser();
            $roleUser->user_id = $superAdmin->id;
            $roleUser->role_id = $role->id;
            $roleUser->save();
           
            if($role->id >= 3){
                $roleUser = new RoleUser();
                $roleUser->user_id = $giselle->id;
                $roleUser->role_id = $role->id;
                $roleUser->save();
            }

            if($role->id >= 3){
                $roleUser = new RoleUser();
                $roleUser->user_id = $rjay->id;
                $roleUser->role_id = $role->id;
                $roleUser->save();
            }
            //Insert roles of Default Admin
            if($role->id >= 2){
                $roleUser = new RoleUser();
                $roleUser->user_id = $admin->id;
                $roleUser->role_id = $role->id;
                $roleUser->save();
            }

             //Insert roles of Default Guidance
           

             //Insert roles of Default Student account
             if($role->id >= 4){
                $roleUser = new RoleUser();
                $roleUser->user_id = $juan->id;
                $roleUser->role_id = $role->id;
                $roleUser->save();
            }
            
            if($role->id >= 4){
                $roleUser = new RoleUser();
                $roleUser->user_id = $bernard->id;
                $roleUser->role_id = $role->id;
                $roleUser->save();
            }

         
       
           
        }      
    }
}
