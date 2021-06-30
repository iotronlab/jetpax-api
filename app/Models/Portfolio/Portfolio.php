<?php

namespace App\Models\Portfolio;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Portfolio extends Model
{
    use HasFactory;
    use AsSource, Attachable;

    protected $table = 'portfolios';

    protected $fillable = [
        'name',
        'url',
        'client_brief',
        'project_description',
        'tools',
        'external_url',
        'meta',
        'status',
        'order',
    ];

    protected $casts = [
        'tools' => 'array',
        'external_url' => 'array',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
