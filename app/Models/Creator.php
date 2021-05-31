<?php

namespace App\Models;

use App\Models\Filter\FilterOption;
use App\Models\Traits\CanBeScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Orchid\Attachment\Models\Attachment;


class Creator extends Model
{
    use HasFactory, CanBeScoped;
    use AsSource, Attachable;

    protected $fillable = [
        'name',
        'email',
        'gender',
        'contact',
        'display_image',
        'cover_image',
        'socials',
        'languages',
        'categories',
        'max_followers',
        'details'
    ];

    protected $casts = [
        'socials' => AsCollection::class,
        'languages' => AsCollection::class,
        'categories' => 'array'
    ];
}
