<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class BudgetScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        return $builder->whereHas('services', function ($builder) use ($value) {
            $builder->where('rate', '<=', $value);
       });
    }
}
