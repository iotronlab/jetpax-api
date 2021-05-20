<?php

namespace Database\Seeders;

use App\Models\Filter\Filter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $json = Storage::disk('local')->get('data/filters.json');
        $filters = json_decode($json);

        foreach($filters as $filter){
            $data = Filter::create(array(
                'code' => $filter->code,
                'admin_name' => $filter->admin_name,
            ));

            foreach($filter->options as $filterChildren){
                $nestedData = $data->options()->create(array(
                    'admin_name' => $filterChildren->admin_name
                ));
            }
        }

    }
}
