<?php

namespace Briofy\Meta\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IMetaRepository
{
    public function list(array $metable = []): LengthAwarePaginator;

    public function single(string|int $value, string $column = 'id'): Model;

    public function store(string $key, $value, array $metable = []): Model;
}
