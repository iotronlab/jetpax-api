<?php

namespace App\Orchid\Screens\Forms;

use App\Helpers\ExcelExport;
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
        return response()->streamDownload(ExcelExport::export(new CreatorForm(), ['id', 'created_at', 'updated_at']), 'test.csv');
    }
}
