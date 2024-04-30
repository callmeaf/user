<?php

namespace Callmeaf\User\Seeders;

use Callmeaf\Permission\Enums\PermissionName;
use Callmeaf\Permission\Enums\RoleName;
use Callmeaf\Permission\Services\V1\PermissionService;
use Callmeaf\Permission\Services\V1\RoleService;
use Callmeaf\User\Services\V1\UserService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $this->makeSuperAdmins();
    }

    private function makeSuperAdmins(): void
    {
        /**
         * @var RoleService $roleService
         */
        $roleService = app(config('callmeaf-role.service'));
        /**
         * @var UserService $userService
         */
        $userService = app(config('callmeaf-user.service'));

        $superAdmins = [
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'superadmin@gmail.com',
                'mobile' => '09100000000',
                'national_code' => '0000000000',
                'password' => 'superadmin@1234!'
            ]
        ];

        foreach ($superAdmins as $superAdmin) {
            $userService->freshQuery()->create(data: $superAdmin)->syncRoles(roles: $roleService->freshQuery()->where(column: 'name',valueOrOperation: RoleName::SUPER_ADMIN->value)->first()->getModel());
        }
    }

}
