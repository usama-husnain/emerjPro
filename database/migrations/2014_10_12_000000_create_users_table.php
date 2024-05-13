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
            $table->string('uuid')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('dob')->nullable();
            $table->string('ibi_id')->nullable();
            $table->string('ibi_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('notes')->nullable();
            $table->string('profile')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('register_ip')->nullable();
            $table->string('register_device')->nullable();
            $table->timestamp('register_at')->nullable();
            $table->string('last_ip')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->boolean('terms_condition')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
