<?php

namespace Database\Seeders;

use App\Models\Creator\Service;

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
            $data = Service::create(array(

                'name' => $service->name,
            ));
        }
    }
}
