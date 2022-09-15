<?php

namespace App\Packages\Pokemon\Tests\Unit;

use App\Packages\Pokemon\Services\Http\Filters\HttpRequestFilters\PokemonFilter;
use Pokemon\PokemonManager;
use Pokemon\Services\Http\HttpPokemonClient;
use Tests\TestCase;

class ManagerFilterTest extends TestCase
{
    public function testPokemonHttpFilterTest()
    {
        $manager = new PokemonManager(
            new HttpPokemonClient()
        );
        $filter = new PokemonFilter();
        $filter->setId(1);
        $response = json_decode($manager->getFilteredData($filter), true);

        $this->assertArrayHasKey( "abilities", $response);
    }
}
