<?php

namespace Callmeaf\User\App\Http\Controllers\Api\V1;

use Callmeaf\Base\App\Http\Controllers\Api\V1\ApiController;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;

class UserController extends ApiController
{
    public function __construct(protected UserRepoInterface $userRepo)
    {
        parent::__construct($this->userRepo->config);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userRepo->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        return $this->userRepo->create(data: $this->request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->userRepo->findById(value: $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        return $this->userRepo->update(id: $id, data: $this->request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->userRepo->delete(id: $id);
    }

    public function trashed()
    {
        return $this->userRepo->trashed();
    }

    public function restore(string $id)
    {
        return $this->userRepo->restore(id: $id);
    }

    public function forceDestroy(string $id)
    {
        return $this->userRepo->forceDelete(id: $id);
    }
}
