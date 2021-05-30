<?php

namespace App\Orchid\Screens\Portfolio;

use App\Models\Portfolio\Portfolio;
use App\Orchid\Layouts\PortfolioListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PortfolioListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'PortfolioListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'PortfolioListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'portfolios' => Portfolio::paginate()
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
                ->route('platform.portfolio.edit')
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
}
