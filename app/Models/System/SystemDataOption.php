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
    ];


    public function system()
    {
        return $this->belongsTo(SystemData::class, 'system_data_code', 'code');
    }
    public function scopeParent($query, $code)
    {
        return $query->where('system_data_code', $code);
    }
}
