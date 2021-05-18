<?php

namespace Database\Seeders;

use App\Models\Creator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CreatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Creator::factory()
                ->times(10)
                ->create();
    }
}
