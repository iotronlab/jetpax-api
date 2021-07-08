<?php

namespace Database\Seeders;

use App\Models\Creator\Creator;
use App\Models\Creator\Service;
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
        $services = Service::where('status', true)->get();
        Creator::factory()
            ->times(10)->hasSocials(3)
            ->hasAttached($services, ['rate' => rand(100, 10000)])
            ->create();
    }
}
