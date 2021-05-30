<?php

namespace App\Orchid\Screens\System;

use App\Models\System\SystemData;
use App\Orchid\Layouts\SystemDataListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class SystemDataListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'SystemData List';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'You can update the system data here.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $systemData = SystemData::with('options')->paginate();
        //dd($systemData);
        return [
            'systemData' => $systemData
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
            Link::make('Create new Data')
                ->icon('pencil')
                ->route('platform.system.edit')
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
            SystemDataListLayout::class
        ];
    }
}
