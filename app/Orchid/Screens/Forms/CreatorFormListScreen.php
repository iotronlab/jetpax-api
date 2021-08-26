<?php

namespace App\Orchid\Screens\Forms;

use App\Models\CreatorForm;
use Illuminate\Support\Arr;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class CreatorFormListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'CreatorFormListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'CreatorFormListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'form' => CreatorForm::paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Export file')
                ->method('export')
                ->icon('cloud-download')
                ->rawClick()
                ->novalidate(),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::table('form', [
                TD::make('name'),
                TD::make('email'),
                TD::make('profile_name', 'Profile Name'),
                TD::make('profile_link', 'Profile Link'),
                TD::make('contact'),
                TD::make('location'),
                TD::make('details'),
            ])
        ];
    }

    public function export()
    {

        return response()->streamDownload(function () {

            $datas = CreatorForm::all()->toArray();

            $data_value = [];
            foreach ($datas as $data) {
                $except_data = Arr::except($data, ['id', 'created_at', 'updated_at']);
                $data_value[] = Arr::flatten($except_data);
            }


            $csv = tap(fopen('php://output', 'wb'), function ($csv) {
                $CreatorObj = new CreatorForm();
                $fillable_data = $CreatorObj->getFillable();
                fputcsv($csv, $fillable_data);
            });

            collect($data_value)->each(function (array $row) use ($csv) {
                fputcsv($csv, $row);
            });

            return tap($csv, function ($csv) {
                fclose($csv);
            });
        }, 'File-name.csv');
    }
}
