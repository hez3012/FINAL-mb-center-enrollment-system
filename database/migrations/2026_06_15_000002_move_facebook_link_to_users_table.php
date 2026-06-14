<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add facebook_link to users table
        Schema::table('users', function (Blueprint $table) {
            $table->string('facebook_link', 500)->nullable()->after('contact_number_2');
        });

        // Remove facebook_link from enrollment table
        Schema::table('enrollment', function (Blueprint $table) {
            $table->dropColumn('facebook_link');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('facebook_link');
        });

        Schema::table('enrollment', function (Blueprint $table) {
            $table->string('facebook_link', 500)->nullable();
        });
    }
};