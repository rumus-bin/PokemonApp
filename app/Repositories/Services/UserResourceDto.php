<?php

namespace App\Repositories\Services;

use App\Core\Database\Services\ResourceDtoInterface;

class UserResourceDto implements ResourceDtoInterface
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?string $rememberToken = null,
        public ?string $authToken = null,
        public ?int $id = null
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
