<?php

namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    protected $table = 'filters';

    protected $fillable = [
        'code',
        'admin_name',
        'order'
    ];

    /**
     * Get the options.
     */
    public function options()
    {
        return $this->hasMany(FilterOption::class,'filter_code','code');
    }


}
