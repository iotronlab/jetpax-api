<?php

namespace Database\Factories\Creator;

use App\Models\Creator\CreatorSocial;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreatorSocialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CreatorSocial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->name(),
            'url'     => $this->faker->unique()->userName(),
            'followers'          => $this->faker->numberBetween(100, 1000000),
            'type' => $this->faker->randomElement(["Instagram", "Facebook", "Youtube", "Twitter"]),
        ];
    }
}
