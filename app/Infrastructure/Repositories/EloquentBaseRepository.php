<?php

namespace App\Infrastructure\Repositories;

use App\Core\Entities\PaginationResult;
use App\Core\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentBaseRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(): array
    {
        return $this->model->all()->toArray();
    }

    public function paginate(int $perPage, int $page): PaginationResult
    {
        $paginator = $this->model->paginate($perPage, ['*'], 'page', $page);

        return new PaginationResult(
            items: $paginator->items(),
            total: $paginator->total(),
            perPage: $paginator->perPage(),
            currentPage: $paginator->currentPage(),
            lastPage: $paginator->lastPage()
        );
    }

    public function findById(int $id): ?object
    {
        return $this->model->find($id);
    }

    public function save(object $entity): object
    {
        if ($entity instanceof Model) {
            $entity->save();

            return $entity;
        }

        throw new \InvalidArgumentException('Entity must be an instance of Eloquent Model');
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id) > 0;
    }
}
