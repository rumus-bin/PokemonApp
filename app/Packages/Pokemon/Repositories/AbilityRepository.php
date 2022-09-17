<?php

namespace Pokemon\Repositories;

use App\Core\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Pokemon\Models\Ability;
use Pokemon\Tools\Model\Paginator;

/**
 * @method LengthAwarePaginator|Ability[] findAll(?Paginator $paginator = null, array $relations = [])
 * @method Ability|null findById(int $id, array $relations = [])
 * @method Ability[]findByField(string $fieldName, mixed $value, array $relations = [])
 * @method Ability store(Model $model)
 * @method null delete(Model $mode)
 * @method null deleteMany(Collection $models)
 * @method null deleteById(int $id)
 * @method Ability|null fresh(Model $model, array $relations = [])
 * @method Ability refresh(Model $model)
 */
class AbilityRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Ability::class);
    }
}
