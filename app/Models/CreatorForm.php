<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class CreatorForm extends Model
{
    use HasFactory, AsSource;
    protected $fillable = [
        'name',
        'email',
        'profile_name',
        'profile_link',
        'contact',
        'location',
        'details'
    ];
}
