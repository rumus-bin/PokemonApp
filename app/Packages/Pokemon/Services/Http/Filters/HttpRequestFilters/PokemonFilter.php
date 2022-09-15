<?php

namespace App\Packages\Pokemon\Services\Http\Filters\HttpRequestFilters;

use App\Packages\Pokemon\Services\RequestModifierInterface;
use Pokemon\Services\ClientInterface;

class PokemonFilter implements RequestModifierInterface
{
    public const PARAMETER_NAME = 'pokemon/';

    private int $id;
    private string $name;
    private bool $list = false;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setListTrue(): void
    {
        $this->list = true;
    }



    public function modify(ClientInterface $client): void
    {
        if ($this->list) {
            $client->setOptions(self::PARAMETER_NAME);
            return;
        }
        if ($this->id) {
            $client->setOptions(self::PARAMETER_NAME . $this->id);
            return;
        }
        if ($this->name) {
            $client->setOptions(self::PARAMETER_NAME . $this->name);
        }
    }
}
