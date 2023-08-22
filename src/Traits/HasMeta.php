<?php

namespace Briofy\Meta\Traits;

use Briofy\Meta\Models\Meta;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMeta
{
    public function meta(): MorphMany
    {
        return $this->morphMany(Meta::class, 'model');
    }
}
