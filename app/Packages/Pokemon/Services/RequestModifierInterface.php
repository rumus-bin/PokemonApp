<?php

namespace App\Packages\Pokemon\Services;

use Pokemon\Services\ClientInterface;

interface RequestModifierInterface
{
    public function modify(ClientInterface $client);
}
