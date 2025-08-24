<?php

namespace App\Core\Interfaces;

use App\Core\Entities\PaginationResult;

interface RepositoryInterface
{
    public function getAll(): array;

    public function paginate(int $perPage, int $page): PaginationResult;

    public function findById(int $id): ?object;

    public function save(object $product): object;

    public function delete(int $id): bool;
}
