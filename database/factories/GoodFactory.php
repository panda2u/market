<?php

namespace Database\Factories;

use App\Models\Good;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Good::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'code' => $this->faker->slug(),
            'image'=> $this->faker->image(),
            'price' => $this->faker->numberBetween(100, 2000),
        ];
    }
}
