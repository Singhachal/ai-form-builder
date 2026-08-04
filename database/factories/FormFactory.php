<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FormFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [

            'title' => $title,

            'slug' => Str::slug($title) . '-' . fake()->unique()->numberBetween(100,999),

            'description' => fake()->paragraph(),

            'is_active' => true,

            'is_public' => true,

            'schema' => null,

        ];
    }
}