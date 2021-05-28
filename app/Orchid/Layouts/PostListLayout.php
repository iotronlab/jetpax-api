<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PostListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'posts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->render(function ( $post) {
                    return Link::make($post->name)
                        ->route('platform.post.edit', $post);
                }),
            TD::make('content', 'Content'),
            TD::make('portfolio_id', 'Portfolio ID'),
            // TD::make('images', 'Images')
            //     ->render(function ($post){
            //         return $post->attachment();
            //     }),

        ];
    }
}
