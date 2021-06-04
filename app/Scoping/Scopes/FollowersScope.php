<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class FollowersScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        // return $builder->whereHas('max_followers', function ($builder) use ($value) {

        //     $builder->whereIn('url', explode(',', $value));
        // });
        $value = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);

        return $builder->where('max_followers','>',$value*100);
    }
}
