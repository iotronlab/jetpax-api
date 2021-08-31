<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class CategoriesScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        // return $builder->whereHas('max_followers', function ($builder) use ($value) {

        //     $builder->whereIn('url', explode(',', $value));
        // });
        // return $builder->where('services', 'like', '%' . $value . '%');
        return $builder->whereJsonContains('categories', explode(',', $value));
    }
}
