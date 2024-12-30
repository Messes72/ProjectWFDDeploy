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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); 
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('school');
            $table->text('alasan'); 
            $table->string('payment_method');
            $table->string('card_number')->nullable(); 
            $table->string('ovo_gopay_number')->nullable(); 
            $table->enum('status', ['pending', 'failed', 'accepted'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};

