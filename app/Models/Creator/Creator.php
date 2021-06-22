<?php

namespace App\Models\Creator;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\CanBeScoped;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Casts\AsCollection;



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
        'short_bio',
        'long_bio',
        'refer_code',
        'referral',
        'status'
    ];

    protected $casts = [
        'socials' => AsArrayObject::class,
        'languages' => AsCollection::class,
        'categories' => 'array'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'creator_service', 'creator_id', 'service_id')->withPivot('rate');
    }

    public function socials()
    {
        return $this->hasMany(CreatorSocial::class);
    }
}
