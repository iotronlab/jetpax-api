<?php

namespace App\Orchid\Layouts;

use App\Models\Creator\Creator;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class CreatorListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'creators';

    /**

     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->render(function (Creator $creator) {
                    return Link::make($creator->name)
                        ->route('platform.creator.edit', $creator);
                }),
            TD::make('email', 'Email'),
            TD::make('contact', 'Contact'),
            TD::make('gender', 'Gender'),

            // TD::make('created_at', 'Created'),
            // TD::make('updated_at', 'Last edit'),
        ];
    }
}
