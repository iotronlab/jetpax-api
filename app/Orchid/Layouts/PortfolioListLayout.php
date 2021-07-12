<?php

namespace App\Orchid\Layouts;

use App\Models\Portfolio\Portfolio;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PortfolioListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'portfolios';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->render(function ($portfolio) {
                    return Link::make($portfolio->name)
                        ->route('platform.portfolio.edit', $portfolio);
                }),
            TD::make('url', 'Url'),
            TD::make('client_brief', 'Client Brief'),
            TD::make('status', 'Status')->render(function ($portfolio) {
                $status = null;
                if ($portfolio->status == 1) {
                    $status = 'ON';
                } else {
                    $status = 'OFF';
                }
                return $status;
            }),
        ];
    }
}
