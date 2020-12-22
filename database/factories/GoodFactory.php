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
        //$storage_path = \Illuminate\Support\Facades\App::storagePath();
        //$needle = '/home/vagrant/code/laravel/storage/app/public_html/uploads';
        //$replacement = 'storage/uploads';

        //$name = $this->faker->name();
        //$code = strtolower(str_replace(' ', '-', str_replace([".", "'"],'', $name)));

        return [
            'price' => $this->faker->numberBetween(100, 2000),
            //'image'=> str_replace($needle, $replacement, $this->faker->image($storage_path.'/app/public_html/uploads',250,250,null,true)),
        ];
    }
}
