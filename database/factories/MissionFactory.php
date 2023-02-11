<?php

namespace Database\Factories;

use App\Models\Mission;
use Illuminate\Database\Eloquent\Factories\Factory;

class MissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>  'Mission',
            'desc'  =>  'To promote a holistic development by helping the students achieve their fullest potentials through the different guidance services.',
            'updated_by'    =>  rand(1,30),
        ];
    }
}
