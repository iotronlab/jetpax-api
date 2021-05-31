<?php

namespace App\Orchid\Screens\Creator;

use App\Models\Creator;
use App\Models\Filter\Filter;
use App\Models\Filter\FilterOption;
use App\Models\System\SystemDataOption;
use App\Models\SystemData;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Radio;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class CreatorEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Add a new Creator';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'creator data form';

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


    public function __construct()
    {
        $this->social = FilterOption::where('filter_code', 'social')->get()->keyBy('admin_name')->transform(function ($item, $key) {
            return $item->admin_name;
        })->toArray();
    }
    public function query(Creator $creator): array
    {
        $this->exists = $creator->exists;

        if ($this->exists) {
            $this->name = 'Edit Creator';
        }

        $creator->load('attachment');
        // dd($creator);

        //dd($social);
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

                Select::make('creator.gender')
                    ->title('Select Gender')->options([
                        'M'   => 'Male',
                        'F' => 'Female',
                        'Universal' => 'Universal',
                    ])->help('Select universal if not sure about gender.'),

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

                // Select::make('creator.socials')->fromQuery(FilterOption::where('filter_code', '=', 'social'), 'admin_name'),
                // ->fromModel(FilterOption::class, 'admin_name'),
                //
                // Select::make('creator.socials')->options($this->social),


                Matrix::make('creator.socials')->title('Socials')
                    ->columns([
                        'type', 'url'
                    ])->fields([
                        'type'  =>
                        Select::make('creator.socials')->options($this->social),
                        'url' =>
                        Input::make()
                    ])->maxRows(5),

                Relation::make('creator.languages.')->fromModel(FilterOption::class, 'admin_name', 'admin_name')
                    ->applyScope('parent', 'languages')->multiple()->title('Languages'),
                Relation::make('creator.categories.')->fromModel(FilterOption::class, 'admin_name', 'admin_name')
                    ->applyScope('parent', 'categories')->multiple()->title('Categories'),


                // Matrix::make('creator.categories')->title('Categories')
                //     ->columns([
                //         'category',
                //     ])->fields([
                //         'category'  => Select::make()
                //             ->fromQuery(FilterOption::where('filter_code', '=', 'categories'), 'admin_name')

                //     ])
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
        $data = $request->get('creator');
        // dd($data);
        $creator->fill($data)->save();

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
