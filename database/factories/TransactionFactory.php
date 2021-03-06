<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        return [
            'ref' => uniqid(),
            'amount' => $this->faker->numberBetween(500, 30000),
            'user_id' => $user->id
        ];
    }
}