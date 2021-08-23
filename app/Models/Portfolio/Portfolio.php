<?php

namespace App\Models\Portfolio;

use App\Models\Attachment;
use App\Models\Traits\CanBeScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Portfolio extends Model
{
    use HasFactory;
    use AsSource, Attachable, CanBeScoped;

    protected $table = 'portfolios';

    protected $fillable = [
        'name',
        'url',
        'client_brief',
        'client_location',
        'project_description',
        'tools',
        'external_url',
        'services',
        'meta',
        'status',
        'order',
    ];

    protected $casts = [
        'tools' => 'array',
        'external_url' => 'array',
        'services' => 'array',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
