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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\SubscriptionType::class);
            $table->string('currency');
            $table->decimal('price', 8, 2);
            $table->string('start_date');
            $table->string('next_billing_date');
            $table->foreignIdFor(\App\Models\SubscriptionStatus::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
