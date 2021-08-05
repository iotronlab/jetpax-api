<?php

namespace App\Orchid\Screens\Creator;

use App\Models\Creator\CreatorSocial;
use App\Models\Filter\FilterOption;
use Illuminate\Database\Eloquent\Relations\Relation;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class SocialEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creator Social Edit Screen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Edit creator social information';

    /**
     * Query data.
     *
     * @return array
     */
    //public $socialFilters = null;
    public function __construct()
    {
        $this->socialFilters = FilterOption::where('filter_code', 'social')->get()->keyBy('admin_name')->transform(function ($item, $key) {
            return $item->admin_name;
        })->toArray();

        // $this->service = null;
    }
    public function query(CreatorSocial $creatorSocial): array
    {
        $this->exists = $creatorSocial->exists;

        if ($this->exists) {
            //$this->name = 'Edit Creator';
            // $creator->load('attachment', 'services', 'socials');
        }


        // dd($creatorSocial);

        //dd($social);
        return [
            'social' => $creatorSocial,
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
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
                    ->placeholder('Enter number of followers'),
                Input::make('social.media_count')
                    ->title('Media Count')
                    ->placeholder('Enter number of followers')

            ]),

        ];
    }
}
