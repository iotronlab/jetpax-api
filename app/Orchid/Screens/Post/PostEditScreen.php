<?php

namespace App\Orchid\Screens\Post;

use App\Models\Portfolio\Post;
use App\Orchid\Layouts\Post\PostEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;


class PostEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Add a post';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Create new post';

    /**
     * Query data.
     *
     * @return array
     */
    public $exists = false;
    public function query(Post $post): array
    {
        $this->exists = $post->exists;

        if ($this->exists) {
            $this->name = 'Edit your post';
            $this->description = 'Edit your post details';
            $post->load('attachment');
        }

        return [
            'post' => $post
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
            Button::make('Create Post')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),

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
            PostEditLayout::class
        ];
    }


    /**
     * @param Post    $post
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function createOrUpdate(Post $post, Request $request)
    {
        $data = $request->get('post');
        $post->fill($data)->save();
        $images = $request->input('post.attachment', []);

        if ($images) {
            $post->attachment()->syncWithoutDetaching(
                $images
            );
        }

        Alert::info('You have successfully saved the post.');
        if ($post->portfolio_id == null) {
            return redirect()->route('platform.post.list');
        } else {
            return redirect()->route('platform.portfolio.edit', $post->portfolio_id);
        }
    }

    /**
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function remove(Post $post)
    {
        // $post->attachment()->each->delete();
        $post->delete();

        Alert::info('You have successfully deleted the post.');

        if ($post->portfolio_id == null) {
            return redirect()->route('platform.post.list');
        } else {
            return redirect()->route('platform.portfolio.edit', $post->portfolio_id);
        }
    }
}
