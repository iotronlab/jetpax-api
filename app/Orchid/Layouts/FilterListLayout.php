<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Creator;
use App\Models\Filter\Filter;
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
    protected $target = 'filterData';

    /**
     * Get the table cells to be displayed.
     *

     */
    protected function columns(): array
    {

        return [
            TD::make('name', 'Filter Name')
                ->render(function ($filterData) {
                    return Link::make($filterData->admin_name)
                        ->route('platform.filter.edit', $filterData);
                }),
            TD::make('code', 'Filter Code'),
            TD::make('options', 'Filter Options')
                ->render(function ($filterData) { {
                        return $filterData->options->transform(function ($item, $key) {
                            return $item->admin_name;
                        });
                    }
                }),

        ];
    }
}
