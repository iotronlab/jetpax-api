<?php

namespace App\Models\Portfolio;

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
        'image',
    ];

    protected $casts = [
        'tools',
        'images'
    ];

    public function images()
    {
        return $this->hasMany(Attachment::class, 'id', 'images');
    }
}
