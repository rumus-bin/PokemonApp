<?php

namespace App\Packages\Pokemon\Repositories\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Pokemon\Models\Pokemon;
use Pokemon\Repositories\PokemonRepository;

class PokemonDbService implements PersistenceServiceInterface
{
    public function __construct(
        private PokemonRepository $pokemonRepository
    ) {
    }

    /**
     * @return Collection<Pokemon>|LengthAwarePaginator
     */
    public function getResourceList(): Collection
    {
        return $this->pokemonRepository->findAll();
    }

    /**
     * @param PokemonResourceDto $resourceDto
     * @return Pokemon
     */
    public function getResource(ResourceDtoInterface $resourceDto): Pokemon
    {
        return $this->pokemonRepository->findById($resourceDto->getId());
    }

    /**
     * @param PokemonResourceDto $resourceDto
     * @return Pokemon
     */
    public function storeResource($resourceDto): Pokemon
    {
        $pokemon = new Pokemon(
            [
                Pokemon::ID => $resourceDto->getId(),
                Pokemon::NAME => $resourceDto->name,
                Pokemon::SOURCE_ID => $resourceDto->sourceId,
                Pokemon::HEIGHT => $resourceDto->height,
                Pokemon::WEIGHT => $resourceDto->weight,
                Pokemon::ORDER => $resourceDto->order,
                Pokemon::IS_DEFAULT => $resourceDto->isDefault,
                Pokemon::BASE_EXPERIENCE => $resourceDto->baseExperience,
                Pokemon::SPRITE_URL => $resourceDto->spriteUrl,
            ]
        );

        return $this->pokemonRepository->store($pokemon);
    }

    public function deleteResource(ResourceDtoInterface $resourceDto)
    {
        return $this->pokemonRepository->deleteById($resourceDto->getId());
    }
}
