<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use HasFactory;
    use AsSource, Attachable;

    protected $table = 'posts';

    protected $fillable = [
        'name',
        'content',
        'portfolio_id',
        'meta',
        'status',
        'order',
    ];

    protected $casts = [
        'external_url' => 'array'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
