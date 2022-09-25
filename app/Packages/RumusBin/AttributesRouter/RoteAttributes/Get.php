<?php

namespace App\Packages\RumusBin\AttributesRouter\RoteAttributes;

use Attribute;
use Illuminate\Support\Str;

#[Attribute]
class Get
{
    public function __construct(
        private readonly string $routePath,
        private readonly ?string $method = 'get'
    ) {
    }

    /**
     * @return string
     */
    public function getRoutePath(): string
    {
        return $this->routePath;
    }

    /**
     * @return array|null
     */
    public function getMethods(): ?array
    {
        return [Str::upper($this->method), 'HEAD'];
    }
}
