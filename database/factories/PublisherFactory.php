<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PublisherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'books_id'   => $this->faker->numberBetween(1, 5),
            'phone'     => $this->faker->phoneNumber(),
            'address'   => $this->faker->address(),
            'name'      => $this->faker->name(),
        ];
    }
}
