<?php

namespace App\Orchid\Screens\Forms;

use App\Models\BusinessForm;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class BusinessFormListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'BusinessFormListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'BusinessFormListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'Form' => BusinessForm::paginate()
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
            Layout::table('Form',[
                TD::make('name'),
                TD::make('email'),
                TD::make('business_name', 'Business Name'),
                TD::make('business_link', 'Business Link'),
                TD::make('contact'),
                TD::make('service'),
                TD::make('budget'),
                TD::make('details'),
            ]
            )

        ];
    }
    public function export()
    {

        return response()->streamDownload(function () {

            $datas = BusinessForm::all();

            $data_values = [];
            foreach ($datas as $key => $data) {
                array_push($data_values, [$data->name, $data->email, $data->business_name, $data->business_link, $data->contact, $data->service, $data->budget, $data->details]);
            };

            $csv = tap(fopen('php://output', 'wb'), function ($csv) {
                fputcsv($csv, ['Name', 'Email', 'Business Name', 'Business Link', 'Contact','Services', 'Budget', 'Details']);
            });

            collect($data_values)->each(function (array $row) use ($csv) {
                fputcsv($csv, $row);
            });

            return tap($csv, function ($csv) {
                fclose($csv);
            });
        }, 'File-name.csv');
    }
}
