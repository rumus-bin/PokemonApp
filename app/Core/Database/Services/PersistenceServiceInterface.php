<?php

namespace App\Core\Database\Services;

interface PersistenceServiceInterface
{
    public function getResourceList();

    public function getResource(ResourceDtoInterface $resourceDto);

    public function storeResource(ResourceDtoInterface $resourceDto);

    public function deleteResource(ResourceDtoInterface $resourceDto);
}
