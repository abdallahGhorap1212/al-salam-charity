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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->comment('إسم الإعداد');
            $table->json('value')->nullable()->comment('قيمة الإعداد');
            $table->string('description')->nullable()->comment('وصف الإعداد');
            $table->enum('type', ['text', 'textarea', 'color', 'email', 'phone', 'url', 'number', 'boolean', 'select'])->default('text')->comment('نوع الإعداد');
            $table->string('category')->default('general')->comment('فئة الإعداد');
            $table->timestamps();

            $table->index('category');
            $table->index('key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
