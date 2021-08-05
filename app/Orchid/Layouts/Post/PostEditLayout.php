<?php

namespace App\Orchid\Layouts\Post;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class PostEditLayout extends Rows
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
            Input::make('post.name')
                ->title('Name')
                ->placeholder('Enter name')->required(),

            TextArea::make('post.content')
                ->title('Content')
                ->placeholder('Enter content')->rows(5)->required(),

            Matrix::make('post.external_url')->title('External Links')
                ->columns([
                    'site',
                    'url',
                ])->fields([
                    'site'   => Input::make()->type('text'),
                    'url' => Input::make()->type('url'),
                ]),
            Matrix::make('post.video_url')->title('Video Links')
                ->columns([
                    'site',
                    'url',
                ])->fields([
                    'site'   => Input::make()->type('text'),
                    'url' => Input::make()->type('url'),
                ]),

            Switcher::make('post.status')->value('post.status')
                ->title('Status')
                ->placeholder('Display Status')->sendTrueOrFalse(),

            Upload::make('post.attachment')->acceptedFiles('image/*')->maxFiles(5)->maxFileSize(0.3)
                ->title('Upload Images')->help('Max file size - 300kb')
                ->horizontal(),
        ];
    }
}
