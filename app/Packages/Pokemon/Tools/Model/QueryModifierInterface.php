<?php

namespace Pokemon\Tools\Model;

use Illuminate\Database\Eloquent\Builder;

interface QueryModifierInterface
{
    public function modify(Builder $builder);
}
