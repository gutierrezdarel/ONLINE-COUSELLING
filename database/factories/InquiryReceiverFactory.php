<?php

namespace Database\Factories;

use App\Models\InquiryReceiver;
use Illuminate\Database\Eloquent\Factories\Factory;

class InquiryReceiverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InquiryReceiver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' =>  'ub.online.counseling@gmail.com',
        ];
    }
}
