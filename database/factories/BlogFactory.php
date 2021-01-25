<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Support\Facades\DB;
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
            'user_id'=>\App\Models\User::all()->random()->id,
            'category_id'=>DB::table('blogs_categories')->inRandomOrder()->first()->id,
            'title'=>$this->faker->title,
            'picture'=>$this->faker->imageUrl(500, 281, 'animals', true),
            'content'=>$this->faker->randomHtml(),
        ];
    }
}
