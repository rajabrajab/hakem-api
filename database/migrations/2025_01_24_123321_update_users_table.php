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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name','full_name');

            $table->dropColumn('email');

            $table->string('phone')->unique();
            $table->string('city');
            $table->string('hood');
            $table->enum('gender', ['Male', 'Female']);
            $table->date('birthday');
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('specialization_id')->nullable();

            $table->softDeletes();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('specialization_id')->references('id')->on('specialties')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
