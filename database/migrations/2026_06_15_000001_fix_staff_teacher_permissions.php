<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $staffRoleId   = DB::table('roles')->where('role_name', 'staff')->value('role_id');
        $teacherRoleId = DB::table('roles')->where('role_name', 'teacher')->value('role_id');

        // ── Get existing users per role ────────────────────────────────────────
        $staffUserIds   = DB::table('users')->whereNull('deleted_at')->where('role_id', $staffRoleId)->pluck('user_id');
        $teacherUserIds = DB::table('users')->whereNull('deleted_at')->where('role_id', $teacherRoleId)->pluck('user_id');

        // ── STAFF: sync previous migration's permissions to existing users ─────
        // (Migration 1 only updated role_permissions, NOT user_permissions)
        // Also add confirm_payment. approve_enrollment is NOT included.
        $staffAddPerms = [
            'create_user', 'edit_user', 'view_user',
            'create_student', 'edit_student', 'delete_student',
            'delete_enrollment',
            'confirm_payment',
        ];

        foreach ($staffAddPerms as $permName) {
            $permId = DB::table('permissions')->where('permission_name', $permName)->value('permission_id');
            if (!$permId) continue;

            DB::table('role_permissions')->insertOrIgnore([
                'role_id'       => $staffRoleId,
                'permission_id' => $permId,
            ]);

            foreach ($staffUserIds as $userId) {
                DB::table('user_permissions')->insertOrIgnore([
                    'user_id'       => $userId,
                    'permission_id' => $permId,
                ]);
            }
        }

        // ── TEACHER: remove update_document_status, edit_enrollment,
        //             upload_document, record_payment ─────────────────────────
        // approve_enrollment is NOT added to teacher.
        $teacherRemovePerms = [
            'update_document_status',
            'edit_enrollment',
            'upload_document',
            'record_payment',
        ];

        $removeIds = DB::table('permissions')
            ->whereIn('permission_name', $teacherRemovePerms)
            ->pluck('permission_id');

        if ($removeIds->isNotEmpty()) {
            DB::table('role_permissions')
                ->where('role_id', $teacherRoleId)
                ->whereIn('permission_id', $removeIds)
                ->delete();

            foreach ($teacherUserIds as $userId) {
                DB::table('user_permissions')
                    ->where('user_id', $userId)
                    ->whereIn('permission_id', $removeIds)
                    ->delete();
            }
        }
    }

    public function down(): void
    {
        // Reversal omitted — permissions are data, not schema.
    }
};