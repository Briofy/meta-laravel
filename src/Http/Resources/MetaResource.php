<?php

namespace Briofy\Meta\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MetaResource extends JsonResource
{
    public function toArray($request): array
    {
        $IdType = config('briofy-meta.database.uuid') ? 'uuid' : 'id';
        return [
            $IdType => $this->id,
            'key' => $this->key,
            'value' => $this->value,
        ];
    }
}
