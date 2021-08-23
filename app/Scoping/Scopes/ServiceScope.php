<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class ServiceScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        // return $builder->whereHas('max_followers', function ($builder) use ($value) {

        //     $builder->whereIn('url', explode(',', $value));
        // });
        return $builder->whereJsonContains('services', explode(',', $value));
    }
}
