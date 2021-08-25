<?php

namespace App\Orchid\Screens\Portfolio;

use App\Models\Portfolio\Portfolio;
use App\Orchid\Layouts\Portfolio\PortfolioListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PortfolioListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Portfolio list';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all your projects/case-studies.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'portfolios' => Portfolio::paginate(10)
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
            Link::make('Create new Portfolio')
                ->icon('pencil')
                ->route('platform.portfolio.edit'),

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
            PortfolioListLayout::class
        ];
    }
    public function export()
    {

        return response()->streamDownload(function () {

            $datas = Portfolio::all();

            $data_values = [];
            foreach ($datas as $key => $data) {
                array_push($data_values, [$data->name, $data->url, $data->client_brief, $data->client_location, $data->project_description, $data->external_url, $data->services, $data->meta, $data->status, $data->order, json_encode($data->tools)]);
            };

            $csv = tap(fopen('php://output', 'wb'), function ($csv) {
                fputcsv($csv, ['Name', 'URL', 'Client Brief', 'Client Location', 'Project_Description', 'Extranal', 'Services', 'Meta', 'Status', 'Order', "Tools"]);
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
