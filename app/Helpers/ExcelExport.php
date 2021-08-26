<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ExcelExport
{
    static public function export(Model $model, array $except_collumn)
    {
dd($model,$except_collumn);
        $model_inside  = $model;
        $datas = $model::all()->toArray();

        $data_value = [];
        foreach ($datas as $data) {
            $except_data = Arr::except($data, $except_collumn);
            $data_value[] = Arr::flatten($except_data);
        }


        $csv = tap(fopen('php://output', 'wb'), function ($csv, $model_inside) {
            $CreatorObj = new $model_inside();
            $fillable_data = $CreatorObj->getFillable();
            fputcsv($csv, $fillable_data);
        });

        collect($data_value)->each(function (array $row) use ($csv) {
            fputcsv($csv, $row);
        });

        return tap($csv, function ($csv) {
            fclose($csv);
        });
    }
}
