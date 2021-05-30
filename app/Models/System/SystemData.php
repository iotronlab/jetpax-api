<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class SystemData extends Model
{
    use HasFactory, AsSource;
    protected $fillable = [
        'code',
    ];
    public function options()
    {
        return $this->hasMany(SystemDataOption::class, 'system_data_code', 'code');
    }
}
