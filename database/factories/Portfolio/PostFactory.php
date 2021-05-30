<?php

namespace Database\Factories\Portfolio;

use App\Models\Portfolio\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'                      => Str::random(10),
            'content'                   => Str::random(30),
        ];
    }
}
