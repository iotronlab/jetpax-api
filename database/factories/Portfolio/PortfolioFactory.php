<?php

namespace Database\Factories\Portfolio;

use App\Models\Portfolio\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PortfolioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Portfolio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->name(),
            'client_brief'              =>  $this->faker->paragraph(2),
            'project_description'       =>     $this->faker->paragraph(4),
            'url'                   =>   $this->faker->slug(2),
            'tools' => $this->faker->randomElements(["Adobe Illustrator", "Adobe Photoshop", "Adobe After Effects", "Adobe Premiere Pro"], 2),
        ];
    }
}
