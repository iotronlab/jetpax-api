<?php

namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class FilterOption extends Model
{
    use HasFactory, AsSource;

    protected $table = 'filter_options';
    protected $fillable = [
        'admin_name',
        'filter_code',
        'order'
    ];
    
    public function filter()
    {
        return $this->belongsTo(Filter::class, 'filter_code', 'code');
    }

    public function scopeParent($query, $code)
    {
        return $query->where('filter_code', $code);
    }
}
