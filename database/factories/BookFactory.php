<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryIds = Category::pluck('id');
        $userIds = User::pluck('id');
        
        return [
            'category_id' => $this->faker->randomElement($categoryIds),
            'user_id' => $this->faker->randomElement($userIds),
        ];
    }
}
