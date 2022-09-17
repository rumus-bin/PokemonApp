<?php

namespace App\Repositories\Services;

use App\Core\Database\Services\PersistenceServiceInterface;
use App\Core\Database\Services\ResourceDtoInterface;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Collection;

class UserService implements PersistenceServiceInterface
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function getResourceList(): Collection
    {
        return $this->userRepository->findAll();
    }

    public function getResource(ResourceDtoInterface $resourceDto): User
    {
        return $this->userRepository->findById($resourceDto->getId());
    }

    public function storeResource(UserResourceDto|ResourceDtoInterface $resourceDto): UserResourceDto
    {
        $token = null;
        $user = $this->userRepository->store(
            new User(
                [
                    User::ID => $resourceDto->getId(),
                    User::NAME => $resourceDto->name,
                    User::EMAIL => $resourceDto->email,
                    User::PASSWORD => $resourceDto->password,
                ]
            )
        );
        if (!$resourceDto->getId()) {
            $token = $user->createToken('NewUserSimpleToken')->plainTextToken;
        }

        $resourceDto->authToken = $token;

        return $resourceDto;
    }

    public function deleteResource(UserResourceDto|ResourceDtoInterface $resourceDto)
    {
        return $this->userRepository->deleteById($resourceDto->getId());
    }
}
