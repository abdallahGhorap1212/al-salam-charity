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
        Schema::table('aid_distributions', function (Blueprint $table) {
            $table->foreignId('distribution_type_id')->nullable()->constrained('distribution_types')->onDelete('set null');
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('currency', 3)->default('EGP');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aid_distributions', function (Blueprint $table) {
            $table->dropForeignIdFor('distribution_type_id');
            $table->dropColumn(['distribution_type_id', 'amount', 'currency']);
        });
    }
};
