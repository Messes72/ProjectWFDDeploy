<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    // public function up(): void
    // {
    //     Schema::table('courses', function (Blueprint $table) {
    //         $table->unsignedBigInteger('teacher_id')->nullable();
    
    //         // Foreign key jika relasi ke teachers
    //         $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
    //     });
    // }

    // public function down(): void
    // {
    //     Schema::table('courses', function (Blueprint $table) {
    //         $table->dropForeign(['teacher_id']);
    //         $table->dropColumn('teacher_id');
    //     });
    // }
};