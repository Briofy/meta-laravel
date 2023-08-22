<?php

namespace Briofy\Meta\Models;

use Database\Factories\MetaFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Meta extends Model
{
    use HasFactory, SoftDeletes;

    private $uuids = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config('briofy-meta.database.connection'));
        $this->uuids = config('briofy-meta.database.uuid', false);
        if($this->uuids){
            $this->primaryKey = 'uuid';
            $this->keyType = 'string';
            $this->incrementing = false;
        }
    }

    protected $fillable = [ 'model_id', 'model_type', 'key', 'value'];

    protected static function newFactory()
    {
        return MetaFactory::new();
    }

    protected function initializeTraits()
    {
        parent::initializeTraits();
        if($this->uuids){
            $this->bootHasUuids();
        }
    }

    protected static function bootHasUuids()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::orderedUuid();
            }
        });
    }

}
