<?php

namespace App\Orchid\Screens\Post;

use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\Post;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Relation as FieldsRelation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class PostEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Add a Post';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Create Post';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Post $post): array
    {
        $this->exists = $post->exists;

        if ($this->exists) {
            $this->name = 'Edit Your Post';
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
            Layout::rows([
                // FieldsRelation::make('post.portfolio_id')
                //     ->fromModel(Portfolio::class, 'name')
                //     ->title('Select Portfolio Id'),

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

            ]),
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
        $images = $request->input('post.images', []);

        if ($images) {
            $post->attachment()->syncWithoutDetaching(
                $images
            );
        }

        Alert::info('You have successfully created an post.');

        // return redirect()->route('platform.post.list');
    }

    /**
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function remove(Post $post)
    {
        $post->attachment()->delete();
        $post->delete();

        Alert::info('You have successfully deleted the post.');

        return redirect()->route('platform.post.list');
    }
}
