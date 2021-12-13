<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productSuffix= ['flower','Ring','Pants', 'T-shirt', 'Basket'];
        $name= $this->faker->company()." ". Arr::random($productSuffix);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'small_description' => $this->faker->realText(200),
            'description' => $this->faker->realText(350),
            'price' => $this->faker->numberBetween(2000,30000) ,
        ];
    }
}
