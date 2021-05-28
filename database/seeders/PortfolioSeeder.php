<?php

namespace Database\Seeders;

use App\Models\Portfolio\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Portfolio::factory()
        //         ->times(5)
        //         ->create();

        for($i =0; $i<5;$i++){
            Portfolio::create(array(
                'name'                      => Str::random(10),
            'client_brief'              => Str::random(15),
            'project_description'       => Str::random(30),
            'typography'                => Str::random(7),
            'palette'                   => Str::random(5),
            'images'                    => []
            ));
        }
    }
}
