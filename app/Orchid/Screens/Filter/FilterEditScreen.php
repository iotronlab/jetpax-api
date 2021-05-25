<?php

namespace App\Orchid\Screens\Filter;

use App\Models\Filter\Filter;
use App\Models\Filter\FilterOption;
use Illuminate\Database\Eloquent\Relations\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class FilterEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Add a new Filter';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Add filters with filter options';

    /**
     * Query data.
     *
     *@param Filter $filter
     *
     * @return array
     */
    public function query(FilterOption $filter_option): array
    {
        $this->exists = $filter_option->exists;

        if($this->exists){
            $this->name = 'Edit filter';
        }
        $opcode = FilterOption::find($filter_option);
        dd($opcode->filter);
        return [
            'filter' => $filter_option
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
                Button::make('Create Filter')
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
                Input::make('filter.filter_code')
                    ->title('Filter Name')
                    ->placeholder('Enter filter name')
                    ->help('Specify a filter name'),

                Input::make('filter.admin_name')
                    ->title('Filter Option')
                    ->placeholder('Enter filter option')
                    ->help("Enter filter option")
                    ->popover('Tooltip - hint that user opens himself.'),
            ])
        ];
    }


    /**
     * @param Filter    $filter
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function createOrUpdate(Request $request)
    {
        $filterData = $request->get('filter');
        $data = Filter::create(array(
            'code' => strtolower($filterData['filter_code']),
            'admin_name' => $filterData['filter_code'],
        ));
        $data->options()->create(array(
            'admin_name' => $filterData['admin_name']
        ));

        Alert::info('You have successfully created an creator.');

        return redirect()->route('platform.filter.list');
    }



    /**
     * @param Creator $creator
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(FilterOption $filter)
    {
        $filter->delete();

        Alert::info('You have successfully deleted the post.');

        return redirect()->route('platform.filter.list');
    }

}
