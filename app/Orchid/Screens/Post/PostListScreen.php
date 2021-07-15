<?php

namespace App\Orchid\Screens\Post;

use App\Models\Portfolio\Post;
use App\Orchid\Layouts\Post\PostListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PostListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Post list';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of independent posts';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {

        return [
            'posts' => Post::where('portfolio_id', null)->paginate(10),
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
            Link::make('Create new Post')
                ->icon('pencil')
                ->route('platform.post.edit')
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
            PostListLayout::class
        ];
    }
}
