<?php

namespace App\Packages\Pokemon\Repositories\Services;

interface PersistenceServiceInterface
{
    public function getResourceList();

    public function getResource(ResourceDtoInterface $resourceDto);

    public function storeResource(ResourceDtoInterface $resourceDto);

    public function deleteResource(ResourceDtoInterface $resourceDto);
}
