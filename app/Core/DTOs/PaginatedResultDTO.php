<?php

namespace App\Core\DTOs;

class PaginatedResultDTO
{
    /**
     * @param  array<mixed>  $items
     */
    public function __construct(
        public readonly array $items,
        public readonly int $total,
        public readonly int $perPage,
        public readonly int $currentPage,
        public readonly int $lastPage,
    ) {}
}
