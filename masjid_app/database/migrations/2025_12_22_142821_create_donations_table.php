<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('donations', function (Blueprint $table) {
        $table->id();
        
        // Gantikan user_id dengan ini:
        // Ini akan automatik create column 'donor_id' dan 'donor_type'
        $table->morphs('donor'); 
        
        // Maklumat derma
        $table->string('transaction_id')->unique();
        $table->decimal('amount', 10, 2);
        $table->string('type')->default('umum');
        $table->string('status')->default('pending');
        $table->text('notes')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
