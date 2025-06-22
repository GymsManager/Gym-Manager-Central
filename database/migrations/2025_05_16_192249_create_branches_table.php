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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gym_id');
            $table->unsignedBigInteger('city_id');
            $table->json('name');
            $table->date('subscribe_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->integer('capacity')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

<<<<<<< HEAD
=======
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');

>>>>>>> 51bd07d (Gym-review)
            $table->foreign('gym_id', 'branches_gym_id_foreign')->references('id')->on('gyms');
            $table->foreign('city_id', 'branches_city_id_foreign')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
