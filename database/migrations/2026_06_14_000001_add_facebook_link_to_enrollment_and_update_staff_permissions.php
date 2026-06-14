<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add facebook_link column to enrollment table
        Schema::table('enrollment', function (Blueprint $table) {
            $table->string('facebook_link', 500)->nullable()->after('remarks');
        });

        // 2. Update staff (role_id=4) role_permissions
        // Staff: add create_user(3), edit_user(4), view_user(6),
        //        create_student(10), edit_student(11), delete_student(12),
        //        delete_enrollment(18)
        $staffRoleId = DB::table('roles')->where('role_name', 'staff')->value('role_id');

        if ($staffRoleId) {
            $permNames = [
                'create_user', 'edit_user', 'view_user',
                'create_student', 'edit_student', 'delete_student',
                'delete_enrollment',
            ];

            foreach ($permNames as $name) {
                $permId = DB::table('permissions')->where('permission_name', $name)->value('permission_id');
                if ($permId) {
                    DB::table('role_permissions')->insertOrIgnore([
                        'role_id'       => $staffRoleId,
                        'permission_id' => $permId,
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        Schema::table('enrollment', function (Blueprint $table) {
            $table->dropColumn('facebook_link');
        });

        $staffRoleId = DB::table('roles')->where('role_name', 'staff')->value('role_id');
        if ($staffRoleId) {
            $permNames = ['create_user','edit_user','view_user','create_student','edit_student','delete_student','delete_enrollment'];
            $permIds   = DB::table('permissions')->whereIn('permission_name', $permNames)->pluck('permission_id');
            DB::table('role_permissions')
                ->where('role_id', $staffRoleId)
                ->whereIn('permission_id', $permIds)
                ->delete();
        }
    }
};