<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->unsignedInteger('family_members_count')->nullable()->after('phone');
            $table->unique('phone');
            $table->unique('national_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropUnique(['phone']);
            $table->dropUnique(['national_id']);
            $table->dropColumn('family_members_count');
        });
    }
};
