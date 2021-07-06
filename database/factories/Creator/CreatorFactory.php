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
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'url'                   => $this->faker->unique()->userName(),
            'contact'                => $this->faker->numerify('##########'),
            'max_followers'          => $this->faker->numberBetween(100, 1000000),
            'gender'                 => $this->faker->randomElement(['M', 'F', 'Universal']),
            'languages' => $this->faker->randomElements(["English", "Hindi", "Bengali", "Tamil", "Telegu"], 3),
            'categories' => $this->faker->randomElements(["Health and Fitness", "Fashion and Lifestyle", "Beauty and Cosmetics", "Gaming and Technology"], 3),
            'short_bio' => $this->faker->paragraph(2),
            'long_bio' => $this->faker->paragraph()
        ];
    }
}
