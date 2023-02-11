<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('term_conditions')->insert([
           'desc'   =>  'Welcome to UB Online Counseling for Junior High School!

           These terms and conditions outline the rules and regulations for the use of the UB-JHOCA Website.
           
           By accessing this website, we assume you accept these terms and conditions. Do not continue to use UB Online Counseling for Junior High School if you do not agree to take all of the terms and conditions stated on this page.
           
           Please read the Terms and Conditions carefully below before fully accessing the website:
           
           Students shall avoid profanity or any harmful act when posting and exchanging conversation with the guidance counselor to observe respect and proper action.
           
           Students shall protect the privacy of both parties. It is not allowed to take a screenshot of the conversation and post it nor share it on any social media sites. The conversation shall remain only between the two parties involved.
           
           The ahead actors on the website should disable your account if you violated the terms and conditions.
           
           Your access to and use of the service is conditioned on your acceptance and compliance with these terms. These terms apply to all students who access or use the website. 
           
           You agree to be bound by these terms by accessing or using the service. If you disagree with any part of the terms, you may not access the website.
           ',
        ]);
    }
}
