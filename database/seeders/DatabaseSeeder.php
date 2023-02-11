<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ServiceTitle;
use App\Models\TermCondition;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            
            SectionSeeder::class,
            UserSeeder::class,
            RolesSeeder::class,
            RoleUsersSeeder::class,
            MissionSeeder::class,
            VisionSeeder::class,
            CommonSeeder::class,
            DefaultSystemUserSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            BannerSeeder::class,
            ServiceTitleSeeder::class,
            AboutTitleSeeder::class,
            TestSeeder::class,
            TermConditionSeeder::class,
            InquiryReceiverSeeder::class,

        ]);
    }
}
