<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class SystemDataOption extends Model
{
    use HasFactory, AsSource;
    protected $fillable = [
        'name',
        'system_data_id',
    ];


    public function system()
    {
        return $this->belongsTo(SystemData::class, 'system_data_code', 'code');
    }
}
