<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Creator;
use App\Models\Filter\FilterOption;
use Orchid\Screen\Actions\Link;

class FilterListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'filter_options';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {

        return [
            TD::make('admin_name', 'Filter Option')
                ->render(function ($filter_option) {
                    return Link::make($filter_option->admin_name)
                        ->route('platform.filter.edit', $filter_option);
                }),
            TD::make('filter_code', 'Filter Name')
                ->render(function ($filter_option) {
                    return $filter_option->filter_code;
                }),
        ];
    }
}
