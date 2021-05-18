<?php

namespace App\Models;

use App\Models\Traits\CanBeScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;
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
        'socials' => 'array',
        'languages' => 'array',
        'categories' => 'array'
    ];

    

    public function scopeFollowers($query)
    {
        return $query->where('max_followers', '>=', 10);
    }
}
