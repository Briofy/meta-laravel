<?php

namespace Briofy\Meta\Jobs;

use Briofy\Meta\Repositories\IMetaRepository;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreMetaJob
{
    use Dispatchable, SerializesModels;

    public function __construct(private string $key, private $value, private array $metable = []) {

    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle(IMetaRepository $metaRepository)
    {
        return $metaRepository->store($this->key, $this->value, $this->metable ?? []);
    }
}