<?php

namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterOption extends Model
{
    use HasFactory;

    protected $table = 'filter_options';
    protected $fillable = [
        'admin_name',
        'filter_code',
        'order'
    ];

    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }
}
