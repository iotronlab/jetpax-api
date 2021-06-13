<?php

namespace Database\Factories\Creator;

use App\Models\Creator\Creator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CreatorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Creator::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name'                   => Str::random(10),
            'email'                  => Str::random(10) . '@gmail.com',
            'contact'                => $this->faker->numerify('##########'),
            'max_followers'          => $this->faker->numberBetween(100, 1000),
            'gender'                 => $this->faker->randomElement(['M', 'F', 'Universal']),
        ];
    }
}
