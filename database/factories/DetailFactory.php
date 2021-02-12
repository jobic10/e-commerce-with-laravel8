<?php

namespace Database\Factories;

use App\Models\Detail;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Detail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sale = Sale::inRandomOrder()->first();
        $product = Product::inRandomOrder()->first();
        return [
            'quantity' => mt_rand(1, 9),
            'sale_id' => $sale->id,
            'product_id' => $product->id,
        ];
    }
}