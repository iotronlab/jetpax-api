<?php

namespace App\Orchid\Screens\Creator;

use App\Models\Creator\Creator;
use App\Models\Creator\CreatorSocial;
use App\Models\Creator\Service;
use App\Models\Filter\Filter;
use App\Models\Filter\FilterOption;

use App\Models\System\SystemDataOption;
use App\Models\SystemData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Radio;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
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
    public $socialFilters = null;

    /**
     * Query data.
     *
     * @param Creator $creator
     *
     * @return array
     */


    public function __construct()
    {
        $this->socialFilters = FilterOption::where('filter_code', 'social')->get()->keyBy('admin_name')->transform(function ($item, $key) {
            return $item->admin_name;
        })->toArray();

        // $this->service = null;
    }
    public function query(Creator $creator): array
    {
        $this->exists = $creator->exists;

        if ($this->exists) {
            $this->name = 'Edit Creator';
            $creator->load('attachment', 'services', 'socials');
        }


        //   dd($creator);

        //dd($social);
        return [
            'creator' => $creator,
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
                ->method('createOrEdit')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrEdit')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),

            ModalToggle::make('Add Service')
                ->modal('serviceModal')
                ->method('createService')
                ->icon('plus')
                ->canSee($this->exists),

            ModalToggle::make('Add Social')
                ->modal('socialModal')
                ->method('createSocial')
                ->icon('plus')
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

            Layout::modal('serviceModal', [
                Layout::rows([
                    Relation::make('service.id')->fromModel(Service::class, 'name')
                        ->title('Services'),
                    Input::make('service.rate')
                        ->title('Rate')
                        ->placeholder('Enter Rate'),
                ])
            ])->title('Add a Service'),

            Layout::modal('socialModal', [
                Layout::rows([
                    Select::make('social.type')->options($this->socialFilters)
                        ->title('Socials'),
                    Input::make('social.name')
                        ->title('Name')
                        ->placeholder('Enter Name'),
                    Input::make('social.url')
                        ->title('Url')
                        ->placeholder('Enter profile url'),
                    Input::make('social.followers')
                        ->title('Followers')
                        ->placeholder('Enter number of followers')

                ])
            ])->title('Add a Social'),



            Layout::rows([
                Input::make('creator.name')
                    ->title('Name')
                    ->placeholder('Enter your name')
                    ->required(),

                Input::make('creator.email')
                    ->title('Email address')
                    ->placeholder('Email address')
                    ->required(),

                Select::make('creator.gender')
                    ->title('Select Gender')->options([
                        'M'   => 'Male',
                        'F' => 'Female',
                        'Universal' => 'Universal',
                    ])->help('Select universal if not sure about gender.')->required(),

                Input::make('creator.contact')
                    ->mask('9999999999')
                    ->title('Phone')
                    ->placeholder('Enter phone number')
                    ->required(),

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


                // Matrix::make('creator.socials')->title('Socials')
                //     ->columns([
                //         'type', 'url'
                //     ])->fields([
                //         'type'  =>
                //         Select::make('creator.socials')->options($this->social),
                //         'url' =>
                //         Input::make()
                //     ])->maxRows(5),

                Relation::make('creator.languages.')->fromModel(FilterOption::class, 'admin_name', 'admin_name')
                    ->applyScope('parent', 'languages')->multiple()->title('Languages'),
                Relation::make('creator.categories.')->fromModel(FilterOption::class, 'admin_name', 'admin_name')
                    ->applyScope('parent', 'categories')->multiple()->title('Categories'),
            ]),



            Layout::table('creator.services', [
                TD::make('name'),
                TD::make('pivot.rate', 'Rate')->sort(),
                TD::make('Action')
                    ->render(function (Service $service) {
                        return
                            Button::make(__('Delete'))
                            ->method('delService')
                            ->icon('trash')
                            ->confirm(__('Are you sure you want to delete the user?'))
                            ->parameters([
                                'creator_id' => $service->pivot->creator_id,
                                'service_id' => $service->id,
                            ]);
                        // DropDown::make()
                        // ->icon('options-vertical')
                        // ->list([
                        //     Button::make(__('Edit'))
                        //         ->route('platform.users.edit', $service->id)
                        //         ->icon('pencil'),
                        //     Button::make(__('Delete'))
                        //         ->method('remove')
                        //         ->icon('trash')
                        //         ->confirm(__('Are you sure you want to delete the user?'))
                        //         ->parameters([
                        //             'id' => $service->id,
                        //         ]),
                        // ])
                    }),
            ])->title('Services')->canSee($this->exists),

            Layout::table('creator.socials', [
                TD::make('name'),
                TD::make('type'),
                TD::make('followers'),
                // //  TD::make('url'),
                TD::make('Action')
                    ->render(function (CreatorSocial $creatorSocial) {
                        return

                            DropDown::make('options')
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->route('platform.social.edit', $creatorSocial->id)
                                    ->icon('pencil'),
                                Button::make(__('Delete'))
                                    ->method('delSocial')
                                    ->icon('trash')
                                    ->confirm(__('Are you sure you want to delete the user?'))
                                    ->parameters([
                                        'social_id' => $creatorSocial->id,
                                    ])
                            ]);
                    }),

            ])->title('Socials')->canSee($this->exists),

        ];
    }

    /**
     * @param Creator    $creator
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrEdit(Creator $creator, Request $request)
    {
        $data = $request->get('creator');

        $creator->fill($data)->save();

        $creator->attachment()->syncWithoutDetaching(
            $request->input('creator.attachment', [])
        );

        Alert::info('You have successfully saved creator data.');

        return redirect()->route('platform.creator.list');
    }

    public function createService(Creator $creator, Request $request)
    {
        $data = $request->get('service');

        $creator->services()->attach(Arr::get($data, 'id'), ['rate' => Arr::get($data, 'rate')]);

        Alert::info('You have successfully added a service.');
    }


    public function delService(Creator $creator, Request $request)
    {
        $id = $request->get('service_id');

        $creator->services()->detach($id);

        Alert::info('You have successfully deleted a service.');
    }

    public function createSocial(Creator $creator, Request $request)
    {
        $data = $request->get('social');

        $creator->socials()->create($data);

        Alert::info('You have successfully added a social.');
    }

    public function delSocial(CreatorSocial $creatorSocial)
    {
        $creatorSocial->delete();

        Alert::info('You have successfully deleted a social.');
    }
    /**
     * @param Creator $creator
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Creator $creator)
    {
        $creator->services()->detach();
        CreatorSocial::where('creator_id', $creator->id)->delete();
        $creator->delete();
        Alert::info('You have successfully deleted the post.');

        return redirect()->route('platform.creator.list');
    }
}
