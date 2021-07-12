<?php

namespace App\Orchid\Screens\Portfolio;

use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\Post;
use App\Models\System\SystemDataOption;
use Illuminate\Http\Request;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
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
            Layout::rows([

                Input::make('portfolio.name')
                    ->title('Name')
                    ->placeholder('Enter your name')
                    ->help('Specify a name')->required(),
                Input::make('portfolio.url')
                    ->title('Project Url')
                    ->placeholder('Unique Url')
                    ->help('Link to be added after domain')->required(),

                TextArea::make('portfolio.client_brief')
                    ->title('Client Brief')
                    ->placeholder('Client brief')->required(),
                Input::make('portfolio.client_location')
                    ->title('Client Location')
                    ->placeholder('Location of client'),

                TextArea::make('portfolio.project_description')
                    ->title('Description')
                    ->placeholder('Enter description')->required(),

                Matrix::make('portfolio.external_url')->title('External Links')
                    ->columns([
                        'site',
                        'url',
                    ])->fields([
                        'site'   => Input::make()->type('text'),
                        'url' => Input::make()->type('url'),
                    ]),

                Relation::make('portfolio.tools.')->fromModel(SystemDataOption::class, 'name', 'name')
                    ->applyScope('parent', 'tools')->multiple()->title('Tools'),

                TextArea::make('portfolio.meta')
                    ->title('Meta Keys')
                    ->placeholder('Enter your meta keys'),
                Input::make('portfolio.order')
                    ->title('Order')
                    ->placeholder('Display order')->type('number'),
                Switcher::make('portfolio.status')->value('portfolio.status')
                    ->title('Status')
                    ->placeholder('Display Status')->sendTrueOrFalse(),

                Upload::make('portfolio.attachment')
                    ->title('Upload Images')
                    ->horizontal()->canSee($this->exists),
            ]),

            Layout::modal('postModal', [
                Layout::rows([

                    Input::make('post.name')
                        ->title('Name')
                        ->placeholder('Enter name'),

                    TextArea::make('post.content')
                        ->title('Content')
                        ->placeholder('Enter content')->rows(5),

                    Matrix::make('post.external_url')->title('External Links')
                        ->columns([
                            'site',
                            'url',
                        ])->fields([
                            'site'   => Input::make()->type('text'),
                            'url' => Input::make()->type('url'),
                        ]),


                    Upload::make('post.attachment')
                        ->title('Upload Images')
                        ->horizontal(),
                ])
            ])->title('Add a Post'),

            Layout::table('portfolio.posts', [
                TD::make('name'),
                TD::make('content'),
                // TD::make('followers'),
                // //  TD::make('url'),
                TD::make('Action')
                    ->render(function (Post $post) {
                        return

                            DropDown::make('options')
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->route('platform.post.edit', $post->id)
                                    ->icon('pencil'),
                                Button::make(__('Delete'))
                                    ->method('delSocial')
                                    ->icon('trash')
                                    ->confirm(__('Are you sure you want to delete the user?'))
                                    ->parameters([
                                        'social_id' => $post->id,
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
        //dd($data);
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
        $post = $portfolio->posts()->create($data);
        // dd($post);
        $images = $request->input('post.attachment', []);
        if ($images) {
            $post->attachment()->syncWithoutDetaching(
                $images
            );
        }

        Alert::info('You have successfully created an post.');
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
