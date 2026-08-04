<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FormFieldFactory extends Factory
{
    public function definition(): array
    {
        $types = [

            'text',
            'email',
            'number',
            'textarea',
            'date'

        ];

        return [

            'label' => fake()->words(2,true),

            'name' => fake()->unique()->slug(),

            'type' => fake()->randomElement($types),

            'placeholder' => fake()->sentence(),

            'help_text' => fake()->sentence(),

            'default_value' => null,

            'required' => fake()->boolean(),

            'options' => null,

            'validation' => null,

            'sort_order' => fake()->numberBetween(1,20),

        ];
    }
}