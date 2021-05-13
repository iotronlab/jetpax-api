<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BusinessForm extends Model
{
    // use HasFactory;
    use HasFactory, Notifiable;
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
