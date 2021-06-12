<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Services extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'name',
    ];

    public function creators()
    {
        return $this->belongsToMany(Creator::class);
    }
}
