<?php

namespace Callmeaf\User\App\Http\Controllers\Web\V1;

use Callmeaf\Base\App\Http\Controllers\Web\V1\WebController;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends WebController implements HasMiddleware
{
    public function __construct(protected UserRepoInterface $userRepo)
    {
        parent::__construct($this->userRepo->config);
    }

    public static function middleware(): array
    {
        return [
           //
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userRepo->all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
