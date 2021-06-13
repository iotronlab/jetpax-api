<?php

namespace App\Orchid\Screens\Creator;

use App\Models\Creator\Creator;
use Orchid\Screen\Screen;
use App\Orchid\Layouts\CreatorListLayout;

use Orchid\Screen\Actions\Link;

class CreatorListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creator List';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of creators/influencers';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'creators' => Creator::paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
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
            CreatorListLayout::class
        ];
    }
}
