<?php

namespace App\Orchid\Layouts\Post;

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

            TD::make('name')->width('30%')->render(function ($post) {
                return Link::make($post->name)
                    ->route('platform.post.edit', $post);
            }),
            TD::make('content')->width('60%'),

            TD::make('status')->width('10%')->render(function ($post) {
                $status = null;
                if ($post->status == 1) {
                    $status = 'ON';
                } else {
                    $status = 'OFF';
                }
                return $status;
            }),
            // TD::make('images', 'Images')
            //     ->render(function ($post){
            //         return $post->attachment();
            //     }),

        ];
    }
}
