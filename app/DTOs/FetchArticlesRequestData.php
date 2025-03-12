<?php

namespace App\DTOs;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class FetchArticlesRequestData extends Data
{
    #[Computed]
    public string $direction;

    public function __construct(
        public ?string $title,
        public ?int $clicks,
        public ?int $views,
        public ?int $page,
        public ?int $limit,
        public ?bool $desc,
        public ?string $sort_by,
    ) {
        $this->page = $this->page ?? 1;
        $this->limit = $this->limit ?? 15;
        $this->sort_by = $this->sort_by ?? 'id';
        $this->direction = $this->desc ? 'desc' : 'asc';
    }
}
