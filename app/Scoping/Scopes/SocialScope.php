<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class SocialScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        // return $builder->whereJsonContains('socials->type',explode(',', $value));
        return $builder->where('socials','like','%'.$value.'%');
    }
}
