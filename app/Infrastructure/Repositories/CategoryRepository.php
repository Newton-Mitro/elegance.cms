<?php

namespace App\Infrastructure\Repositories;

use App\Core\Interfaces\RepositoryInterface;
use App\Models\Product;

class CategoryRepository extends EloquentBaseRepository implements RepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    // Here you can add domain-specific queries,
    // e.g. findByCategory, findBySlug, etc.
}
