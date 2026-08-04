<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FormSubmissionValueFactory extends Factory
{
    public function definition(): array
    {
        return [

            'value' => fake()->sentence(),

        ];
    }
}