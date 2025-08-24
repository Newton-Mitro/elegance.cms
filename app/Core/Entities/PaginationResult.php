<?php

namespace App\Core\Entities;

class PaginationResult
{
    public function __construct(
        public array $items,
        public int $total,
        public int $perPage,
        public int $currentPage,
        public int $lastPage
    ) {}
}
