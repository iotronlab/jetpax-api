<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class ServiceScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        return $builder->whereJsonContains('services', explode(',', $value));
    }
}
