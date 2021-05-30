<?php

namespace App\Orchid\Screens\Filter;

use App\Models\Filter\Filter;
use App\Models\Filter\FilterOption;
use App\Orchid\Layouts\FilterListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class FilterListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Filters List Screen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of filters to apply for creators.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $filterData =  Filter::with('options')->paginate();
        //dd($filterData);
        return [
            'filterData' => $filterData
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
            Link::make('Create new Filter')
                ->icon('pencil')
                ->route('platform.filter.edit')
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
            FilterListLayout::class
        ];
    }
}
