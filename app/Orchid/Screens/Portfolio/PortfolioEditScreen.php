<?php

namespace App\Orchid\Screens\Portfolio;

use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\Post;
use App\Orchid\Layouts\Portfolio\PortfolioEditLayout;
use App\Orchid\Layouts\Post\PostEditLayout;
use Illuminate\Http\Request;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;

use Orchid\Screen\Screen;

use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class PortfolioEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create new Case Study';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Create a new entry in your portfolio';

    /**
     * Query data.
     *
     * @return array
     */
    public $exists = false;
    public function query(Portfolio $portfolio): array
    {
        $this->exists = $portfolio->exists;
        $this->portfolio = $portfolio;
        if ($this->exists) {
            $this->name = 'Edit your portfolio';
            $this->description = 'Edit your case study details';
            $portfolio->load(['attachment', 'posts']);
        }

        return [
            'portfolio' => $portfolio,
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
            Button::make('Create Portfolio')
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

            ModalToggle::make('Add Post')
                ->modal('postModal')
                ->method('createPost')
                ->icon('full-screen')
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
            PortfolioEditLayout::class,

            Layout::modal('postModal', [
                PostEditLayout::class
            ])->title('Add a Post'),

            Layout::table('portfolio.posts', [
                TD::make('name')->width('30%'),
                TD::make('content')->width('50%'),

                TD::make('Action')->width('20%')
                    ->render(function (Post $post) {
                        return

                            DropDown::make('options')
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->route('platform.post.edit', $post->id)
                                    ->icon('pencil'),
                                Button::make(__('Delete'))
                                    ->method('delPost')
                                    ->icon('trash')
                                    ->confirm(__('Are you sure you want to delete this post?'))
                                    ->parameters([
                                        'post_id' => $post->id,
                                    ])
                            ]);
                    }),

            ])->title('Posts')->canSee($this->exists),
        ];
    }

    /**
     * @param Portfolio    $portfolio
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function createOrUpdate(Portfolio $portfolio, Request $request)
    {

        $data = $request->get('portfolio');

        $portfolio->fill($data)->save();
        $images = $request->input('portfolio.attachment', []);

        if ($images) {
            $portfolio->attachment()->syncWithoutDetaching(
                $images
            );
        }

        Alert::info('You have successfully saved a portfolio.');

        return redirect()->route('platform.portfolio.list');
    }

    /**
     * @param Portfolio    $portfolio
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function createPost(Portfolio $portfolio, Request $request)
    {

        $data = $request->get('post');
        $post = $portfolio->posts()->create($data);

        $images = $request->input('post.attachment', []);
        if ($images) {
            $post->attachment()->syncWithoutDetaching(
                $images
            );
        }

        Alert::info('You have successfully saved a post.');
    }

    public function delPost(Post $post)
    {
        $post->delete();

        Alert::info('You have successfully deleted a post.');
    }
    /**
     * @param Portolio $portfolio
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Portfolio $portfolio)
    {
        $portfolio->attachment->each->delete();
        $portfolio->posts->each->delete();
        $portfolio->delete();

        Alert::info('You have successfully deleted the portfolio.');

        return redirect()->route('platform.portfolio.list');
    }
}
