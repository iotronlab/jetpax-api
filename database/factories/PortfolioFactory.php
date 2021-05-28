<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Portfolio\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
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
            'name'                      => Str::random(10),
            'client_brief'              => Str::random(15),
            'project_description'       => Str::random(30),
            'typography'                => Str::random(7),
            'pallete'                   => Str::random(5),
        ];
    }
}
