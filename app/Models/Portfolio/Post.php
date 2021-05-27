<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use HasFactory;
    use AsSource,Attachable;

    protected $table = 'posts';

    protected $fillable = [
        'type',
        'name',
        'content',
        'portfolio_id',
        'images'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
