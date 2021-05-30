<?php

namespace Database\Seeders;

use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\Post;
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
        Portfolio::factory()
                ->times(5)
                ->has(Post::factory()->count(3),'posts')
                ->create();

    }
}
