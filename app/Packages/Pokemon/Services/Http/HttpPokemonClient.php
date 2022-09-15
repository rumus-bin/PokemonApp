<?php

namespace Pokemon\Services\Http;

use Pokemon\Exceptions\PokemonHttpClientException;
use Pokemon\Services\ClientInterface;
use Illuminate\Support\Facades\Http;

class HttpPokemonClient implements ClientInterface
{
    public const FIRST_CHAR_CHECK = '/';
    public const CHAR_OFFSET = 1;

    public function __construct(
        private ?string $baseUrl = 'https://pokeapi.co/api/v2/',
        private ?string $requestParameters = ''
    ) {
    }

    /**
     * @return array
     * @throws PokemonHttpClientException
     */
    public function fetchData(): array
    {
       return $this->makeRequest();
    }

    public function setOptions($options): self
    {
        $this->requestParameters = $options;

        return $this;
    }

    /**
     * @return array
     * @throws PokemonHttpClientException
     */
    private function makeRequest(): array
    {
        $this->validateParameters();
        $requestUrl = $this->baseUrl . $this->requestParameters;
        try {
            $response = Http::get($requestUrl);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Throwable $exception) {
            throw new PokemonHttpClientException(
                message: $exception->getMessage(),
                code: $exception->getCode()
            );
        }
    }

    private function validateParameters(): void
    {
        if ($this->requestParameters && $this->requestParameters[0] === self::FIRST_CHAR_CHECK) {
            $this->requestParameters = substr($this->requestParameters, self::CHAR_OFFSET);
        }
    }
}
