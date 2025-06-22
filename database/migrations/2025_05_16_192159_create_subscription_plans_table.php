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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('currency')->default('USD');
            $table->decimal('price', 10, 2);
            $table->integer('duration_in_days');
            $table->json('features')->nullable();
=======
            $table->json('name');
            $table->json('description')->nullable();
            $table->string('currency')->default('USD');
            $table->decimal('price', 10, 2);
            $table->integer('duration_in_days');
            // $table->json('features')->nullable();
>>>>>>> 51bd07d (Gym-review)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
