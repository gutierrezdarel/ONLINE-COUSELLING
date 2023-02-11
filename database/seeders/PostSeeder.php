<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();
        foreach($users as $user){
            $posts = rand(1,10);
            $userId = $user->id;
            $user = $user->roles->pluck('role');
            
            for($i=0; $i<=$posts; $i++){
                if(!$user->contains('Guidance') && $user->contains('Student')){
                    DB::table('posts')->insert([
                        'user_id'   =>  $userId,
                        'category_id'   =>  rand(1,3),
                        'title'  =>  $faker->sentence(),
                        'post'  =>  $faker->paragraph().' '.$faker->paragraph(),
                        'created_at'    =>  $faker->dateTime(),
                    ]);
                } 
            }
           
        }
       
    }
}
