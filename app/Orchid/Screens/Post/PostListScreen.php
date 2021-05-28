<?php

namespace App\Orchid\Screens\Post;

use App\Models\Portfolio\Post;
use App\Orchid\Layouts\PostListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PostListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'PostListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'PostListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Post $post): array
    {

        return [
            'posts' => Post::paginate(10),
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
