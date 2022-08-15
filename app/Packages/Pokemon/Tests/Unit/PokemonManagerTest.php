<?php

namespace Pokemon\Tests\Unit;

use Pokemon\Models\Pokemon;
use Pokemon\PokemonManager;
use Pokemon\Services\Http\HttpPokemonClient;
use Pokemon\Tests\Helpers\HttpResponseTestHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PokemonManagerTest extends TestCase
{
    public const TEST_SOURCE_ID = 1;

    use RefreshDatabase;

    public function testStoreDataInDbForSourceId(): void
    {
        $correctResponse = HttpResponseTestHelper::getCorrectResponseData();
        $testUrl = HttpResponseTestHelper::TEST_BASE_CLIENT_URL .
            HttpResponseTestHelper::TEST_URL_POKEMON_OPTION .
            '*';
        Http::fake([
            $testUrl => Http::response($correctResponse)
        ]);

        $manager = new PokemonManager(new HttpPokemonClient());

        $manager->storeDataInDbForSourceId(self::TEST_SOURCE_ID);

        $this->assertDatabaseHas(
            Pokemon::TABLE_NAME,
            [
                Pokemon::NAME => $correctResponse['name'],
                Pokemon::SOURCE_ID => $correctResponse['id']
            ]
        );
    }

}
