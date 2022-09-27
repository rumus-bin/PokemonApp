<?php

namespace RumusBin\AttributesRouter\src\RoteAttributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class ScopeBindings implements RouteAttribute
{
    public function __construct(
        public bool $scopeBindings = true
    ) {
    }
}
