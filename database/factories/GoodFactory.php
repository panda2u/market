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
        $name = $this->faker->name();
        $code = strtolower(str_replace(' ', '-', str_replace([".", "'"],'', $name)));
        $path_prefix = '/storage/';
        $dt = date('Ymd-his'); // TODO: get local time
        $size = '2560x1440'; //TODO: upload image and get it width and height
        return [
            'name' => $name,
            'code' => $code,
            'image'=> $path_prefix.$dt.$name.$size,
            'price' => $this->faker->numberBetween(100, 2000),
        ];
    }
}
