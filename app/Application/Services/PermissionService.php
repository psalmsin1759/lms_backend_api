<?php

namespace App\Application\Services;

use App\Enums\UserRole;
use App\Models\Permission;

class PermissionService
{
    public function forRole(UserRole $role): array
    {
        return Permission::query()
            ->join('role_permissions', 'permissions.id', '=', 'role_permissions.permission_id')
            ->where('role_permissions.role', $role->value)
            ->pluck('permissions.name')
            ->values()
            ->toArray();
    }
}
