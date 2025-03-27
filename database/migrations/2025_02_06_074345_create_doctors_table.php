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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string("full_name")->nullable();
            $table->string("clinic_location")->nullable();
            $table->time("clinic_start_time")->nullable();
            $table->time("clinic_end_time")->nullable();
            $table->integer("appointment_duration")->nullable();
            $table->integer("can_book_for")->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained('specialties')->onDelete('cascade');
            $table->string('detailed_specialization')->nullable();
            $table->text('bio')->nullable();
            $table->enum('gender', ['Male', 'Female']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
