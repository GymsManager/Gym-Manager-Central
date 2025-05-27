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
        Schema::create('gym_policies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gym_id');
            $table->json('terms')->nullable();
            $table->json('policy')->nullable();
            $table->string('terms_file')->nullable();
            $table->string('privacy_file')->nullable();
            $table->string('side_effects_file')->nullable();
            $table->string('faq_file')->nullable();
            $table->timestamps();

            $table->foreign('gym_id', 'gym_policies_gym_id_foreign')
                ->references('id')->on('gyms')
                ->onDelete('cascade');
            $table->index('gym_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_policies');
    }
};
