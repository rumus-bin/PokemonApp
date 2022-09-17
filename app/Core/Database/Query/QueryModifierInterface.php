<?php

namespace App\Core\Database\Query;

use Illuminate\Database\Eloquent\Builder;

interface QueryModifierInterface
{
    public function modify(Builder $builder);
}
