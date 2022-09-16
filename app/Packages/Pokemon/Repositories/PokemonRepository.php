<?php

namespace Pokemon\Repositories;

use Pokemon\Models\Pokemon;
use Pokemon\Tools\Model\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * @method LengthAwarePaginator|Collection|Pokemon[] findAll(?Paginator $paginator = null, array $relations = [])
 * @method Pokemon|null findById(int $id, array $relations = [])
 * @method Collection|Pokemon[]findByField(string $fieldName, mixed $value, array $relations = [])
 * @method Pokemon store(Model $model)
 * @method null delete(Model $mode)
 * @method null deleteMany(Collection $models)
 * @method null deleteById(int $id)
 * @method Pokemon|null fresh(Model $model, array $relations = [])
 * @method Pokemon refresh(Model $model)
 */
class PokemonRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Pokemon::class);
    }
}
