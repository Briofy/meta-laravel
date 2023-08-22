<?php

namespace Briofy\Meta\Repositories;

use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Briofy\Meta\Models\Meta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class MetaRepository extends AbstractRepository implements IMetaRepository
{
    public function list(array $metable = []): LengthAwarePaginator
    {
        if ($metable) return $this->model->where('metable_id', $metable['id'])->where('metable_type', $metable['type'])->paginate();
        return $this->model->paginate();
    }

    public function single(string|int $value, string $column = 'id'): Model
    {
        return $this->model->where($column, $value)->firstOrFail();
    }

    public function store(string $key, $value, array $metable = []): Model
    {
        $data = ['key' => $key, 'value' => $value];
        if ($metable) {
            $data['metable_id'] = $metable['id'];
            $data['metable_type'] = $metable['type'];
        }
        $meta = $this->model->create($data);
        return $meta;
    }

    protected function instance(array $attributes = []): Model
    {
        return new Meta();
    }
}
