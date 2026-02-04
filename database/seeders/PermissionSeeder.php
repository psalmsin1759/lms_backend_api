<?php

use App\Enums\Permission;
use App\Enums\UserRole;
use App\Models\Permission as PermissionModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        foreach (Permission::cases() as $permission) {
            PermissionModel::firstOrCreate([
                'name' => $permission->value,
            ]);
        }

        // Role → Permission mapping
        $map = [

            // PLATFORM
            UserRole::SUPER_ADMIN->value => Permission::cases(),
            UserRole::PLATFORM_SUPPORT->value => [
                Permission::VIEW_ANALYTICS,
            ],
            UserRole::PLATFORM_FINANCE->value => [
                Permission::MANAGE_BILLING,
            ],

            // ORGANIZATION
            UserRole::ORG_ADMIN->value => [
                Permission::MANAGE_USERS,
                Permission::ENROLL_USERS,
                Permission::CREATE_COURSE,
                Permission::PUBLISH_COURSE,
                Permission::ISSUE_CERTIFICATE,
                Permission::VIEW_ANALYTICS,
            ],

            UserRole::ORG_MANAGER->value => [
                Permission::MANAGE_USERS,
                Permission::ENROLL_USERS,
                Permission::VIEW_ANALYTICS,
            ],

            UserRole::CONTENT_ADMIN->value => [
                Permission::CREATE_LESSON,
                Permission::UPDATE_LESSON,
                Permission::CREATE_QUIZ,
            ],

            // COURSE
            UserRole::INSTRUCTOR->value => [
                Permission::CREATE_COURSE,
                Permission::UPDATE_COURSE,
                Permission::CREATE_LESSON,
                Permission::GRADE_ASSIGNMENT,
            ],

            UserRole::TEACHING_ASSISTANT->value => [
                Permission::GRADE_ASSIGNMENT,
            ],
        ];

        foreach ($map as $role => $permissions) {
            foreach ($permissions as $permission) {
                DB::table('role_permissions')->insert([
                    'role' => $role,
                    'permission_id' => PermissionModel::where(
                        'name',
                        $permission->value
                    )->value('id'),
                ]);
            }
        }
    }
}
