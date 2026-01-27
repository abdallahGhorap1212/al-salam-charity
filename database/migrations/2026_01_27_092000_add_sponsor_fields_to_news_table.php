<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('sponsor_title')->nullable()->after('cover_image');
            $table->text('sponsor_body')->nullable()->after('sponsor_title');
            $table->string('sponsor_link')->nullable()->after('sponsor_body');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['sponsor_title', 'sponsor_body', 'sponsor_link']);
        });
    }
};
