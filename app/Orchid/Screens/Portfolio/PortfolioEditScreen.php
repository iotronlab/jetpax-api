<?php

namespace App\Orchid\Screens\Portfolio;

use App\Models\Portfolio\Portfolio;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class PortfolioEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'PortfolioEditScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'PortfolioEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Portfolio $portfolio): array
    {
        $this->exists = $portfolio->exists;

        if($this->exists){
            $this->name = 'Edit Portfolio';
        }

        // $portfolio->load('attachment');
        // dd($portfolio->images);
        $portfolio->attachment($portfolio->images)->get();
        return [
            'portfolio' => $portfolio
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

                Input::make('portfolio.typography')
                    ->title('Typography')
                    ->placeholder('Enter typography'),

                Input::make('portfolio.palette')
                    ->title('Palette')
                    ->placeholder('Enter palette'),

                Cropper::make('portfolio.image')
                    ->title('Enter image')
                    ->width(500)
                    ->height(300)
                    ->horizontal(),

                Upload::make('portfolio.images')
                    ->title('Upload multiple images')
                    ->horizontal(),

            ])
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
        $data['images'] = json_encode($data['images']);
        $portfolio->fill($data)->save();

        $portfolio->attachment()->syncWithoutDetaching(
            $request->input('portfolio.attachment', [])
        );

        Alert::info('You have successfully created an portfolio.');

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
        $portfolio->delete();

        Alert::info('You have successfully deleted the post.');

        return redirect()->route('platform.portfolio.list');
    }

}
