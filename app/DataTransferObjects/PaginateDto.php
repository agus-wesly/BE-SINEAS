<?php

namespace App\DataTransferObjects;

class PaginateDto
{

    public function __construct(
        public readonly ?int $perPage = null,
        public readonly ?int $page = null,
        public readonly ?string $pageName = null,
    ){}

    public static function fromRequest(array $request): self
    {
        return new self(
            perPage: $request['per_page']?? null ,
            page: $request['page'] ?? null ,
            pageName: $request['page_name'] ?? null,
        );
    }
}
