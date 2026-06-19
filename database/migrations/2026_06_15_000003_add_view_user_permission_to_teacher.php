<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $teacherRoleId = DB::table('roles')->where('role_name', 'teacher')->value('role_id');
        $permId        = DB::table('permissions')->where('permission_name', 'view_user')->value('permission_id');

        if ($teacherRoleId && $permId) {
            // Add to role_permissions
            DB::table('role_permissions')->insertOrIgnore([
                'role_id'       => $teacherRoleId,
                'permission_id' => $permId,
            ]);

            // Add to all existing teacher users
            $teacherUserIds = DB::table('users')
                ->whereNull('deleted_at')
                ->where('role_id', $teacherRoleId)
                ->pluck('user_id');

            foreach ($teacherUserIds as $userId) {
                DB::table('user_permissions')->insertOrIgnore([
                    'user_id'       => $userId,
                    'permission_id' => $permId,
                ]);
            }
        }
    }

    public function down(): void
    {
        $teacherRoleId = DB::table('roles')->where('role_name', 'teacher')->value('role_id');
        $permId        = DB::table('permissions')->where('permission_name', 'view_user')->value('permission_id');

        if ($teacherRoleId && $permId) {
            DB::table('role_permissions')
                ->where('role_id', $teacherRoleId)
                ->where('permission_id', $permId)
                ->delete();

            $teacherUserIds = DB::table('users')
                ->whereNull('deleted_at')
                ->where('role_id', $teacherRoleId)
                ->pluck('user_id');

            foreach ($teacherUserIds as $userId) {
                DB::table('user_permissions')
                    ->where('user_id', $userId)
                    ->where('permission_id', $permId)
                    ->delete();
            }
        }
    }
};