<?php

namespace App\Models\Portfolio;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use HasUuid, HasFactory;
    use AsSource, Attachable;

    protected $table = 'posts';

    protected $fillable = [
        'name',
        'content',
        'meta',
        'external_url',
        'video_url',
        'status',
        'order',
    ];

    protected $casts = [
        'external_url' => 'array',
        'video_url' => 'array'
    ];

    protected static function booted()
    {
        static::deleted(function ($post) {
            $post->attachment->each->delete();
        });
    }

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
