<?php

namespace Pokemon\Tests\Unit;

use Pokemon\Services\Http\HttpPokemonClient;
use Pokemon\Tests\Helpers\HttpResponseTestHelper;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class HttpPokemonClientTest extends TestCase
{

    public function testPokemonHttpClient(): void
    {
        $correctResponse = HttpResponseTestHelper::getCorrectResponseData();
        $testUrl = HttpResponseTestHelper::TEST_BASE_CLIENT_URL .
            HttpResponseTestHelper::TEST_URL_POKEMON_OPTION .
            '*';
        Http::fake([
            $testUrl => Http::response($correctResponse)
        ]);
        $client = new HttpPokemonClient();
        $client->setOptions($testUrl . 1);
        $responseData = $client->fetchData();

        $this->assertEquals($correctResponse['id'], $responseData['id']);
    }
}
