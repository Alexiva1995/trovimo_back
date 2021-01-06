<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->title,
            'picture'=>$this->faker->imageUrl(500, 281, 'animals', true),
            'content'=>$this->faker->randomHtml(),
            'user_id'=>\App\Models\User::all()->random()->id,
        ];
    }
}
