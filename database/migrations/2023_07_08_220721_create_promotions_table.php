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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            
            // Foreign keys indicating the previous academic status
            $table->unsignedBigInteger('from_grade_id');
            $table->unsignedBigInteger('from_classroom_id');
            $table->unsignedBigInteger('from_section_id');
            
            // Foreign keys indicating the new academic status
            $table->unsignedBigInteger('to_grade_id');
            $table->unsignedBigInteger('to_classroom_id');
            $table->unsignedBigInteger('to_section_id');
            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            
            // Foreign keys referencing the previous academic status
            $table->foreign('from_grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('from_classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->foreign('from_section_id')->references('id')->on('sections')->onDelete('cascade');
            
            // Foreign keys referencing the new academic status
            $table->foreign('to_grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('to_classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->foreign('to_section_id')->references('id')->on('sections')->onDelete('cascade');
            
            $table->string('from_academic_year');
            $table->string('to_academic_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
