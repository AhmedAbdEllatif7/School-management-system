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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            // Father information
            $table->string('father_name');
            $table->string('father_national_id');
            $table->string('father_passport_id');
            $table->string('father_phone');
            $table->string('father_job');

            $table->unsignedBigInteger('father_nationality');
            $table->unsignedBigInteger('father_blood_type');
            $table->unsignedBigInteger('father_religion');

            // Relations
            $table->foreign('father_nationality')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('father_blood_type')->references('id')->on('bloods')->onDelete('cascade');
            $table->foreign('father_religion')->references('id')->on('religions')->onDelete('cascade');

            $table->string('father_address');

            // Mother information
            $table->string('mother_name');
            $table->string('mother_national_id');
            $table->string('mother_passport_id');
            $table->string('mother_phone');
            $table->string('mother_job');

            $table->unsignedBigInteger('mother_nationality');
            $table->unsignedBigInteger('mother_blood_type');
            $table->unsignedBigInteger('mother_religion');

            // Relations
            $table->foreign('mother_nationality')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('mother_blood_type')->references('id')->on('bloods')->onDelete('cascade');
            $table->foreign('mother_religion')->references('id')->on('religions')->onDelete('cascade');

            $table->string('mother_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
