<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Creator;
use App\Models\Filter\FilterOption;
use Orchid\Screen\Actions\Link;

class SystemDataListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'systemData';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {

        return [
            TD::make('code', 'Code Name')
                ->render(function ($systemData) {
                    return Link::make($systemData->code)
                        ->route('platform.system.edit', $systemData);
                }),
            TD::make('options', 'Code Options')
                ->render(function ($systemData) { {
                        return $systemData->options->transform(function ($item, $key) {
                            return $item->name;
                        });
                    }
                }),
        ];
    }
}
