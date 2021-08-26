<?php

namespace App\Orchid\Layouts\Portfolio;

use App\Models\System\SystemDataOption;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class PortfolioEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
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
                ->applyScope('parent', 'Tools')->multiple()->title('Tools'),
            Relation::make('portfolio.services.')->fromModel(SystemDataOption::class, 'name', 'name')
                ->applyScope('parent', 'Business Services')->multiple()->title('Services'),

            TextArea::make('portfolio.meta')
                ->title('Meta Keys')
                ->placeholder('Enter your meta keys'),
            Input::make('portfolio.order')
                ->title('Order')
                ->placeholder('Display order')->type('number'),
            Switcher::make('portfolio.status')->value('portfolio.status')
                ->title('Status')
                ->placeholder('Display Status')->sendTrueOrFalse(),

            Upload::make('portfolio.attachment')->acceptedFiles('image/*')->maxFiles(5)->maxFileSize(0.512)
                ->title('Upload Images')->help('Max file size - 512kb')
                ->horizontal(),
        ];
    }
}
