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
        'client_brief',
        'project_description',
        'tools',
        'images',
        'typography',
        'palette',
    ];

    protected $casts = [
        'tools' => 'array',
        'images' => 'array'
    ];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
