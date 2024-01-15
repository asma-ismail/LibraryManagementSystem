<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'genre_id' => fake()->numberBetween(1, 7),
            'author' => fake()->name(),
            'ISBN' => fake()->isbn10(),
            'language' => fake()->languageCode(),
            'cover' => fake()->image(),
            'membership_id' => fake()->numberBetween(1, 4),
            'publisher' => fake()->company(),
            'date_of_publication' => fake()->date(),
            'path' => '/books',

        ];
    }
}
