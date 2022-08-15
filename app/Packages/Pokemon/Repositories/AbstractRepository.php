<?php

namespace Pokemon\Repositories;

use Pokemon\Tools\Model\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class AbstractRepository
{
    protected Model $model;

    protected function __construct(string $modelFQN)
    {
        $this->model = new $modelFQN();
    }

    public function findById(int $id, array $relations = []): ?Model
    {
        $qb = $this->createQueryBuilder();
        if ($relations) {
            $qb->with($relations);
        }
        return $qb->find($id);

    }

    public function findByField(string $fieldName, mixed $value, array $relations = []): Collection
    {
        $qb = $this->createQueryBuilder();
        return $qb->with($relations)
            ->where($fieldName, $value)
            ->get();
    }

    public function findAll(?Paginator $paginator = null, array $relations = []): Collection|LengthAwarePaginator
    {
        return $paginator ?
            $this->findAllPaginated($paginator, $relations) :
            $this->createQueryBuilder()->with($relations)->get();
    }

    public function findAllPaginated(Paginator $paginator, array $relations = []): LengthAwarePaginator
    {
        $qb = $this->createQueryBuilder()->with($relations);

        return $paginator->modify($qb);
    }

    protected function createQueryBuilder(): Builder
    {
        return $this->model->newQuery();
    }

    public function delete(Model $mode): void
    {
        $mode->delete();
    }

    public function deleteById(int $id): void
    {
        $this->findById($id)?->delete();
    }

    /**
     * @param Collection<Model> $models
     * @return void
     */
    public function deleteMany(Collection $models): void
    {
        foreach ($models as $model) {
            $model->delete();
        }
    }

    public function store(Model $model): Model
    {
        $model->save();

        return $model;
    }

    /**
     * @param Collection<Model> $models
     * @return void
     */
    public function storeMany(Collection $models): void
    {
        foreach ($models as $model) {
            $model->save();
        }
    }

    public function fresh(Model $model, array $relations = []): ?Model
    {
        return $model->fresh($relations);
    }

    public function refresh(Model $model): Model
    {
        return $model->refresh();
    }
}
