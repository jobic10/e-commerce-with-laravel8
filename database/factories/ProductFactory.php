<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = Category::inRandomOrder()->first();
        $name = $this->faker->lastName . " " . $this->faker->monthName;

        return [
            'category_id' => $id->id,
            'name' => $name,
            'slug' => Str::slug(substr($name, 0, 18) . " " . date('mdyhis')),
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(500, 50000),
            'photo' => $this->faker->lastName,
        ];
    }
}