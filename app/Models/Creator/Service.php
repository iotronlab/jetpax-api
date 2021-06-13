<?php

namespace App\Models\Creator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Service extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'name',
    ];

    public function creators()
    {
        return $this->belongsToMany(Creator::class, 'creator_service', 'service_id', 'creator_id');
    }
}
