<?php

namespace App\Orchid\Screens\Portfolio;

use App\Models\Portfolio\Portfolio;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class PortfolioEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create New Portfolio';

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
    public function query(Portfolio $portfolio): array
    {
        $this->exists = $portfolio->exists;

        if ($this->exists) {
            $this->name = 'Edit Your Portfolio';
            $portfolio->load(['attachment', 'posts']);
        }
        // $posts = $portfolio->posts;
        // dd($posts);

        // dd($portfolio);
        return [
            'portfolio' => $portfolio,
            'posts' => $portfolio->posts
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
            Layout::rows([
                Input::make('portfolio.name')
                    ->title('Name')
                    ->placeholder('Enter your name')
                    ->help('Specify a name'),

                Input::make('portfolio.client_brief')
                    ->title('Client brief')
                    ->placeholder('Client brief'),

                Input::make('portfolio.project_description')
                    ->title('Description')
                    ->placeholder('Enter description'),


                Upload::make('portfolio.attachment')
                    ->title('Upload multiple images')
                    ->horizontal()->canSee($this->exists),
            ]),

            // Layout::modal('postModal', [
            //     Layout::rows([
            //         Input::make('post.type')
            //                 ->title('Type')
            //                 ->placeholder('Enter type'),

            //         Input::make('post.name')
            //                 ->title('Name')
            //                 ->placeholder('Enter name'),

            //         Input::make('post.content')
            //                 ->title('Content')
            //                 ->placeholder('Enter content'),

            //         Upload::make('post.images')
            //                 ->title('Upload multiple images')
            //                 ->horizontal(),
            //     ])
            // ])->title('Add a Post'),

            // Layout::legend('posts', [
            //     Sight::make('type'),
            //     Sight::make('name'),
            //     Sight::make('content'),
            // ]),
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
        // $data['images'] = $data['attachment'];
        $portfolio->fill($data)->save();
        $images = $request->input('portfolio.attachment', []);

        if ($images) {
            $portfolio->attachment()->syncWithoutDetaching(
                $images
            );
        }

        Alert::info('You have successfully created an portfolio.');

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
        $portfolio->posts()->updateOrCreate($data);
        $portfolio->attachment()->syncWithoutDetaching(
            $request->input('post.images', [])
        );

        Alert::info('You have successfully created an post.');

        return redirect()->route('platform.portfolio.list');
    }

    /**
     * @param Portolio $portfolio
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Portfolio $portfolio)
    {
        $portfolio->attachment()->delete();
        $portfolio->delete();

        Alert::info('You have successfully deleted the post.');

        return redirect()->route('platform.portfolio.list');
    }
}
