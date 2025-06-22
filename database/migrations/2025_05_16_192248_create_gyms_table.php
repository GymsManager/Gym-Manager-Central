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
        Schema::create('gyms', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->index();
            $table->string('slug')->unique()->index();
            $table->json('name');
            // $table->string('email')->unique();
            // $table->string('mobile')->nullable();
            $table->enum('status', ['active', 'inactive', 'expired', 'suspended'])->default('active')->index();
            $table->boolean('has_application')->default(false);
            $table->foreignId('subscription_plan_id')->nullable()->constrained()->index();
<<<<<<< HEAD
=======
            $table->uuid('client_key')->unique()->nullable()->index();
            $table->string('shared_secret', 64)->nullable();
            $table->boolean('is_registered')->default(false)->index();
            $table->timestamp('registered_at')->nullable();
>>>>>>> 51bd07d (Gym-review)
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gyms');
    }
};
