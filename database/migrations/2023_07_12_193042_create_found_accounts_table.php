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
        Schema::create('found_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('payment_id')->nullable()->references('id')->on('student_payments')->onDelete('cascade');
            $table->foreignId('receipt_id')->nullable()->references('id')->on('receipts')->onDelete('cascade');
            $table->decimal('Debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('found_accounts');
    }
};
