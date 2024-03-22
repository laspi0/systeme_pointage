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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('cni')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('cjm')->nullable();
            $table->enum('profile_type', ['teacher', 'admin']);
            $table->string('schedule')->nullable();
            $table->integer('amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
