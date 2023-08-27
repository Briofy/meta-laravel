<?php

namespace Briofy\Meta\Models;

use Database\Factories\MetaFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Meta extends Model
{
    use HasFactory, SoftDeletes;

    private $uuids = false;

    protected $table = 'meta';

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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($meta) {
            if(Schema::getColumnType('meta', 'id')==='string') $meta->id = (string) Str::orderedUuid();
        });
    }

}
