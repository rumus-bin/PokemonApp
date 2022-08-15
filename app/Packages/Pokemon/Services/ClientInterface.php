<?php

namespace Pokemon\Services;

interface ClientInterface
{
    public function fetchData();

    public function setOptions($options);
}
