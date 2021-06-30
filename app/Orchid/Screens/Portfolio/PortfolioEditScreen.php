<?php

namespace App\Orchid\Screens\Portfolio;

use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\Post;
use Illuminate\Http\Request;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
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
    public function query(Portfolio $portfolio, Post $posts): array
    {
        $this->exists = $portfolio->exists;
        $this->portfolio = $portfolio;
        if ($this->exists) {
            $this->name = 'Edit Your Portfolio';
            $portfolio->load(['attachment', 'posts']);
        }
        // $posts = $portfolio->posts;
        // dd($posts);

        // dd($portfolio);
        return [
            'portfolio' => $portfolio,
            'posts' => $posts
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

                TextArea::make('portfolio.client_brief')
                    ->title('Client brief')
                    ->placeholder('Client brief'),

                TextArea::make('portfolio.project_description')
                    ->title('Description')
                    ->placeholder('Enter description'),

                Matrix::make('portfolio.external_url')->title('External Links')
                    ->columns([
                        'site',
                        'url',
                    ])->fields([
                        'site'   => Input::make()->type('text'),
                        'url' => Input::make()->type('text'),
                    ]),


                Matrix::make('portfolio.tools')->title('Tools')
                    ->columns([
                        'tool',

                    ])->fields([
                        'tool'   => Select::make()
                            ->options([
                                1   => 'Photoshop',
                                2 => 'illustrator',
                            ])

                    ]),
                TextArea::make('portfolio.meta')
                    ->title('Meta Keys')
                    ->placeholder('Enter your meta keys'),

                Upload::make('portfolio.attachment')
                    ->title('Upload multiple images')
                    ->horizontal()->canSee($this->exists),
            ]),

            Layout::modal('postModal', [
                Layout::rows([

                    Input::make('post.name')
                        ->title('Name')
                        ->placeholder('Enter name'),

                    TextArea::make('post.content')
                        ->title('Content')
                        ->placeholder('Enter content'),

                    Upload::make('post.images')
                        ->title('Upload multiple images')
                        ->horizontal(),
                ])
            ])->title('Add a Post'),

            // Layout::legend('posts', [
            //     Sight::make('name'),
            //     Sight::make('content'),
            // ])->canSee($this->exists),
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
        //dd($data);
        $portfolio->fill($data)->save();
        $images = $request->input('portfolio.attachment', []);
        $links = $request->get('portfolio.external_url');
        if ($links) {
            dd($links);
        }
        if ($images) {
            $portfolio->attachment()->syncWithoutDetaching(
                $images
            );
        }

        // Alert::info('You have successfully created an portfolio.');

        // return redirect()->route('platform.portfolio.list');
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

        // return redirect()->route('platform.portfolio.list');
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

        Alert::info('You have successfully deleted the portfolio.');

        return redirect()->route('platform.portfolio.list');
    }
}
