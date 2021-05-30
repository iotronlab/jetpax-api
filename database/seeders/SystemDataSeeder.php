<?php

namespace Database\Seeders;

use App\Models\System\SystemData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SystemDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('data/system-data.json');
        $datas = json_decode($json);

        foreach ($datas as $data) {
            $systemData = SystemData::updateOrCreate(array(

                'code' => $data->name,
            ));

            foreach ($data->options as $dataChildren) {
                $systemData->options()->create(array(
                    'name' => $dataChildren->name
                ));
            }
        }
    }
}
