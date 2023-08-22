<?php

namespace Briofy\Meta\Http\Controllers;

use Briofy\Meta\Http\Requests\StoreRequest;
use Briofy\Meta\Jobs\StoreMetaJob;
use Briofy\RestLaravel\Http\Controllers\RestController;
use Briofy\Meta\Http\Resources\MetaResource;
use Briofy\Meta\Repositories\IMetaRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;

class ApiController extends RestController
{

    public function __construct(
        private IMetaRepository $metaRepository
    ) {
    }

    public function index(Request $r): JsonResponse
    {
        try{
            $metable = $r->metable ?? [];
            if (!array_key_exists('id', $metable) || !array_key_exists('type', $metable)) $metable = [];
            return $this->respond(MetaResource::collection($this->metaRepository->list($metable)));
        }catch (\Exception $exception){
            return $this->respondWithError($exception);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            return $this->respond(MetaResource::make($this->metaRepository->single($id)));
        } catch (ModelNotFoundException $exception) {
            return $this->respondEntityNotFound($exception);
        }
    }

    public function store(StoreRequest $r): JsonResponse
    {
        try{
            return $this->respond(MetaResource::make(dispatch_sync(new StoreMetaJob($r->key, $r->value, $r->metable ?? []))));
        }catch (\Exception $exception){
            return $this->respondWithError($exception);
        }
    }
}
