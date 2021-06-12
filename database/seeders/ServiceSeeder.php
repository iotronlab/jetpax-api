<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('data/services.json');
        $services = json_decode($json);

        foreach ($services as $service) {
            $data = Services::create(array(

                'name' => $service->name,
            ));
        }
    }
}
