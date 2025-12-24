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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            // Tambah lajur ini (Foreign Key untuk AJK/Committee)
            $table->foreignId('committee_id')->constrained('committees')->onDelete('cascade');
            
            // Lajur untuk Event (Foreign Key)
            $table->foreignId('event_id')->nullable()->constrained('events')->onDelete('cascade');
            
            $table->text('description');
            $table->string('status')->default('pending'); // pending, approved, rejected, completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};