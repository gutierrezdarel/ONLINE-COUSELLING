<?php

namespace Database\Factories;

use App\Models\Common;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Common::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>  'Goals',
            'desc'  =>  'The guidance and counseling office aims to mold well - SHAPED individuals by : Assisting students gain self - understanding of their potentials, interests and aptitude necessary for their personal, academic, spiritual and career development; helping them secure self - direction, discipline, confidence, self - respect and interest in school, home and socio - civic activities; and enhancing the knowledge, skills and moral development of the students. Thereby making them : Socially Competent, Honest and Responsible, Academically Inclined, Positive and Determined, Enthusiastic to Serve and Devoted to God.',
            'updated_by'    =>  rand(1,30),
        ];
    }
}
