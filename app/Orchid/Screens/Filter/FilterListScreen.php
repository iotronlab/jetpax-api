<?php

namespace App\Orchid\Screens\Filter;

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
    public $name = 'FilterListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'FilterListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'filter_options' => FilterOption::paginate()
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
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.creator.edit')
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
