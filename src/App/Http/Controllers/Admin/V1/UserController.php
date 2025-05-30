<?php

namespace Callmeaf\User\App\Http\Controllers\Admin\V1;

use Callmeaf\Base\App\Enums\ExportType;
use Callmeaf\Base\App\Enums\ImportType;
use Callmeaf\Base\App\Http\Controllers\Admin\V1\AdminController;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class UserController extends AdminController implements HasMiddleware
{
    public function __construct(protected UserRepoInterface $userRepo)
    {
        parent::__construct($this->userRepo->config);
    }

    public static function middleware()
    {
        $importRateLimitRequest = \Base::config(key: 'import_rate_limit_request');
        $exportRateLimitRequest = \Base::config(key: 'export_rate_limit_request');
        return [
            new Middleware(middleware: "custom_throttle:$importRateLimitRequest,1", only: ['import']),
            new Middleware(middleware: "custom_throttle:$exportRateLimitRequest,1", only: ['export'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userRepo->latest()->search()->paginate();
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
        return $this->userRepo->trashed()->latest()->search()->paginate();
    }

    public function restore(string $id)
    {
        return $this->userRepo->restore(id: $id);
    }

    public function forceDestroy(string $id)
    {
        return $this->userRepo->forceDelete(id: $id);
    }

    public function updatePassword(string $id)
    {
        return $this->userRepo->updatePassword(id: $id, password: $this->request->get('password'));
    }

    public function updateStatus(string $id)
    {
        return $this->userRepo->update(id: $id, data: [
            'status' => $this->request->get('status'),
        ]);
    }

    public function updateType(string $id)
    {
        return $this->userRepo->update(id: $id, data: [
            'type' => $this->request->get('type'),
        ]);
    }

    public function export(string $type)
    {
        return $this->userRepo->export(type: ExportType::from($type));
    }

    public function import(string $type)
    {
        $file = Storage::disk('local')->putFile('temp', $this->request->file('file'));

        $importer = $this->userRepo->import(type: ImportType::from($type), file: Storage::disk('local')->path($file));

        Storage::disk('local')->delete($file);

        return response()->json([
            'total' => $importer->getTotal(),
            'success' => $importer->getSuccess(),
        ]);
    }

    public function syncRoles(string $id)
    {
        return $this->userRepo->syncRoles(id: $id,rolesIds: $this->request->get('roles_ids') ?? []);
    }
}
