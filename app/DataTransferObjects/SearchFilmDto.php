<?php

namespace App\DataTransferObjects;

use Illuminate\Http\Request;

class SearchFilmDto
{
    public function __construct(
        public readonly ?string $search = null,
        public readonly ?bool $new = null,
        public readonly ?string $sort = null,
        public readonly ?int $perPage = null,
        public readonly ?int $page = null,
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            search: $request->search,
            new: $request->new,
            sort: $request->sort,
            perPage: $request->per_page,
            page: $request->page,
        );
    }
}
