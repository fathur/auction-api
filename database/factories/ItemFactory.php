<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $initialPrice = $this->faker->randomNumber(2, false);
        $highestPrice = $this->faker->numberBetween($initialPrice, $initialPrice + 1 + $this->faker->randomNumber(2, false));

        $productName = $this->faker->name . ' ' . 
            $this->faker->randomElement(['Exclusive', 'Rare', 'Special']) . ' ' .
            $this->faker->randomElement(["Shoes", 'Shirt', 'Bottle', 'Guitar', 'Piano', 'Cow']);

        return [
            'name'  => $productName,
            'description'  => $this->faker->paragraph(5),
            'expiry_at'  => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'image_url'  => $this->faker->imageUrl(360, 360, 'animals', true, 'cats', true),
            'initial_price'  => $initialPrice,
            'highest_bidder_username'  => $this->faker->randomElement(
                collect(config('auth.hard_code_users'))->pluck('username')
            ),
            'highest_bid_price'  => $highestPrice,
        ];
    }
}
