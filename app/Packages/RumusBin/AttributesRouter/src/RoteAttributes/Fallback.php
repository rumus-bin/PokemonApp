<?php

namespace RumusBin\AttributesRouter\src\RoteAttributes;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Fallback
{
    public function __construct()
    {
    }
}
