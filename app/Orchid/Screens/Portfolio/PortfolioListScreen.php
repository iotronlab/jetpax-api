<?php

namespace App\Orchid\Screens\Portfolio;

use App\Models\Portfolio\Portfolio;
use App\Orchid\Layouts\Portfolio\PortfolioListLayout;
use Illuminate\Support\Arr;
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

            $datas = Portfolio::all()->toArray();

            $data_value = [];
            foreach ($datas as $data) {
                $except_data = Arr::except($data, ['id', 'created_at', 'updated_at']);
                $data_value[] = Arr::flatten($except_data);
            };

            
            $csv = tap(fopen('php://output', 'wb'), function ($csv) {
                $BusinessObj = new Portfolio();
                $fillable_data = $BusinessObj->getFillable();

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
