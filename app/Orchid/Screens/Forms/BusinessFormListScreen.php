<?php

namespace App\Orchid\Screens\Forms;

use App\Helpers\ExcelExport;
use App\Models\BusinessForm;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Arr;

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
            Layout::table(
                'Form',
                [
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

        return response()->streamDownload(ExcelExport::export(new BusinessForm(), ['id', 'created_at', 'updated_at']), 'test.csv');
    }
}
