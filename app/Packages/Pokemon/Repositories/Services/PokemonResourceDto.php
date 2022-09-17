<?php

namespace App\Packages\Pokemon\Repositories\Services;

use App\Core\Database\Services\ResourceDtoInterface;

class PokemonResourceDto implements ResourceDtoInterface
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $sourceId,
        public int $height,
        public int $weight,
        public int $order,
        public bool $isDefault,
        public int $baseExperience,
        public ?string $spriteUrl = null
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
