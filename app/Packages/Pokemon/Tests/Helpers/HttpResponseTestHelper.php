<?php

namespace Pokemon\Tests\Helpers;

class HttpResponseTestHelper
{
    public const TEST_URL_POKEMON_OPTION = 'pokemon/';
    public const TEST_BASE_CLIENT_URL = 'https://pokeapi.co/api/v2/';

    public static function getCorrectResponseData(): array
    {
        return [
            'name' => 'Test name',
            'id' => 124,
            'height' => 100,
            'weight' => 65,
            'is_default'=> true,
            'order' => 10,
            'base_experience' => 25,
            'abilities' => [
                [
                    'ability' => [
                        'name' => 'Ability name 1',
                        'url' => 'Ability url 1'
                    ],
                    'is_hidden' => true,
                    'slot' => 1
                ],
                [
                    'ability' => [
                        'name' => 'Ability name 2',
                        'url' => 'Ability url 2'
                    ],
                    'is_hidden' => false,
                    'slot' => 2
                ]
            ],
            'sprites' => [
                'front_default' => 'Front sprite default',
                'back_default' => 'Back sprite default'
            ]
        ];
    }
}
