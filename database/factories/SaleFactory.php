<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $transaction = Transaction::inRandomOrder()->first();
        $product = Product::inRandomOrder()->first();
        return [
            'transaction_id' => $transaction->id,
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => mt_rand(1, 4)
        ];
    }
}