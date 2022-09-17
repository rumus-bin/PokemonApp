<?php

namespace App\Repositories;

use App\Core\Repositories\AbstractRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Pokemon\Tools\Model\Paginator;

/**
 * @method LengthAwarePaginator|Collection|User[] findAll(?Paginator $paginator = null, array $relations = [])
 * @method User|null findById(int $id, array $relations = [])
 * @method Collection|User[]findByField(string $fieldName, mixed $value, array $relations = [])
 * @method User store(Model $model)
 * @method null delete(Model $mode)
 * @method null deleteMany(Collection $models)
 * @method null deleteById(int $id)
 * @method User|null fresh(Model $model, array $relations = [])
 * @method User refresh(Model $model)
 */
class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }
}
