<?php

namespace Pokemon;

use Pokemon\Models\Ability;
use Pokemon\Models\Pokemon;
use Pokemon\Repositories\AbilityRepository;
use Pokemon\Repositories\PokemonRepository;
use Pokemon\Services\ClientInterface;
use Illuminate\Support\Facades\DB;

class PokemonManager
{
    public const DATA_KEY_ABILITY = 'ability';
    public const POKEMON_RESOURCE = 'pokemon/';

    private ClientInterface $client;
    private AbilityRepository $abilityRepository;
    private PokemonRepository $pokemonRepository;

    public function __construct(
        ClientInterface $client
    ) {
        $this->client = $client;
        $this->abilityRepository = app(AbilityRepository::class);
        $this->pokemonRepository = app(PokemonRepository::class);
    }

    /**
     * @param int $sourceId
     * @return Pokemon
     * @throws \Throwable
     */
    public function storeDataInDbForSourceId(int $sourceId): Pokemon
    {
        DB::beginTransaction();
        try {
            $this->client->setOptions(self::POKEMON_RESOURCE . $sourceId);
            $pokemonData = $this->client->fetchData();
            $storedPokemon = $this->storePokemon($pokemonData);
            $this->storeAbilitiesForPokemonId($pokemonData['abilities'], $storedPokemon->id);
            DB::commit();

            return $storedPokemon;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }

    }

    private function storeAbilitiesForPokemonId(array $abilities, int $pokemonId): void
    {
        $modelsCollection = collect([]);
        foreach ($abilities as $ability) {
            $modelsCollection->push(
                new Ability(
                    [
                        Ability::NAME => $ability[self::DATA_KEY_ABILITY][Ability::NAME],
                        Ability::URL => $ability[self::DATA_KEY_ABILITY][Ability::URL],
                        Ability::IS_HIDDEN => $ability[Ability::IS_HIDDEN],
                        Ability::SLOT => $ability[Ability::SLOT],
                        Ability::POKEMON_ID => $pokemonId

                    ]
                )
            );
        }
        $this->abilityRepository->storeMany($modelsCollection);
    }

    private function storePokemon(array $pokemonData): Pokemon
    {
        $pokemonModel = new Pokemon(
            [
                Pokemon::SOURCE_ID => $pokemonData['id'],
                Pokemon::NAME => $pokemonData[Pokemon::NAME],
                Pokemon::ORDER => $pokemonData[Pokemon::ORDER],
                Pokemon::WEIGHT => $pokemonData[Pokemon::WEIGHT],
                Pokemon::BASE_EXPERIENCE => $pokemonData[Pokemon::BASE_EXPERIENCE],
                Pokemon::IS_DEFAULT => $pokemonData[Pokemon::IS_DEFAULT],
                Pokemon::HEIGHT => $pokemonData[Pokemon::HEIGHT],
                Pokemon::SPRITE_URL => $pokemonData['sprites']['front_default']
            ]
        );

        return $this->pokemonRepository->store($pokemonModel);
    }
}
