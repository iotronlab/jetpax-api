<?php

namespace App\Models\Creator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\CanBeScoped;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Casts\AsCollection;


class Creator extends Model
{
    use HasFactory,
        CanBeScoped,
        AsSource,
        Attachable;

    protected $fillable = [
        'name',
        'email',
        'url',
        'gender',
        'contact',
        'alt_contact',
        'display_image',
        'cover_image',
        'languages',
        'categories',
        'max_followers',
        'short_bio',
        'long_bio',
        'refer_code',
        'referral',
        'status'
    ];

    protected $casts = [
        'languages' => AsCollection::class,
        'categories' => AsCollection::class
    ];

    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'creator_service', 'creator_id', 'service_id')
            ->withPivot('rate', 'details', 'status');
    }

    public function socials()
    {
        return $this->hasMany(CreatorSocial::class);
    }
}
