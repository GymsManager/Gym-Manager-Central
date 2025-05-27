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
        Schema::create('branch_configs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->string('workout_type')->nullable();
            $table->integer('reward_points')->default(0);
            $table->string('unit');
            $table->decimal('reward_value', 8, 2)->default(0);
            $table->string('membership_type')->nullable();
            $table->decimal('vat', 5, 2)->default(0);
            $table->boolean('coin_login')->default(false);
            $table->timestamps();

            $table->foreign('branch_id', 'branch_configs_branch_id_foreign')
                ->references('id')->on('branches')
                ->onDelete('cascade');
            $table->index('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_configs');
    }
};
