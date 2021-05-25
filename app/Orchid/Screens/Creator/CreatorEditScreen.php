<?php

namespace App\Orchid\Screens\Creator;

use App\Models\Creator;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Radio;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class CreatorEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating a new post';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Blog posts';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Creator $creator
     *
     * @return array
     */
    public function query(Creator $creator): array
    {
        $this->exists = $creator->exists;

        if($this->exists){
            $this->name = 'Edit creator';
        }

        $creator->load('attachment');

        return [
            'creator' => $creator
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create Creator')
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
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('creator.name')
                    ->title('Name')
                    ->placeholder('Enter your name')
                    ->help('Specify a name'),

                Input::make('creator.email')
                    ->title('Email address')
                    ->placeholder('Email address')
                    ->help("We'll never share your email with anyone else.")
                    ->popover('Tooltip - hint that user opens himself.'),

                Radio::make('creator.gender')
                    ->placeholder('Male')
                    ->value('M')
                    ->title('Gender'),

                Radio::make('creator.gender')
                    ->placeholder('Female')
                    ->value('F'),
                Radio::make('creator.gender')
                    ->placeholder('Others')
                    ->value('Universal'),

                Input::make('creator.contact')
                    ->mask('9999999999')
                    ->title('Phone')
                    ->placeholder('Enter phone number')
                    ->help('Number Phone'),
                Cropper::make('creator.display_image')
                    ->title('Display Image')
                    ->width(1000)
                    ->height(500),
                Cropper::make('creator.cover_image')
                    ->title('Cover Image')
                    ->width(1000)
                    ->height(500),
            ])
        ];
    }

    /**
     * @param Creator    $creator
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Creator $creator, Request $request)
    {
        $creator->fill($request->get('creator'))->save();

        $creator->attachment()->syncWithoutDetaching(
            $request->input('creator.attachment', [])
        );

        Alert::info('You have successfully created an creator.');

        return redirect()->route('platform.creator.list');
    }

    /**
     * @param Creator $creator
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Creator $creator)
    {
        $creator->delete();
        Alert::info('You have successfully deleted the post.');

        return redirect()->route('platform.creator.list');
    }
}
