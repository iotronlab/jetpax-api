<?php

namespace App\Models\Creator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class CreatorSocial extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'name',
        'type',
        'url',
        'followers',
        'status',
        'creator_id'
    ];

    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }
}
