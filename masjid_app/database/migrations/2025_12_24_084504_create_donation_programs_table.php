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
    Schema::create('donation_programs', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Nama Program
        $table->text('description')->nullable(); // Penerangan
        $table->decimal('target_amount', 15, 2); // Sasaran (RM 10,000)
        $table->decimal('current_amount', 15, 2)->default(0); // Terkumpul (RM 500)
        $table->enum('status', ['active', 'completed', 'inactive'])->default('active');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_programs');
    }
};
