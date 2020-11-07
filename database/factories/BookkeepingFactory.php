<?php

namespace Database\Factories;

use App\Models\Bookkeeping;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookkeepingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bookkeeping::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sha256,
            'type' => $this->faker->randomElement(['increase', 'decrease']),
            'amount' => $this->faker->numberBetween(1, 9999),
        ];
    }
}
