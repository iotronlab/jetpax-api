<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Orchid\Screen\AsSource;

class BusinessForm extends Model
{
    // use HasFactory;
    use HasFactory, Notifiable, AsSource;
    protected $fillable = [
        'name',
        'email',
        'business_name',
        'business_link',
        'contact',
        'service',
        'budget',
        'details'
    ];
}
