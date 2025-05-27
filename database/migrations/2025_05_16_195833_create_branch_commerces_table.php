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
        Schema::create('branch_commerces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->string('tax_number')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('merchant_name')->nullable();
            $table->string('merchant_key')->nullable();
            $table->string('currency')->default('USD');
            $table->string('commercial_register_number')->nullable();
            $table->timestamps();

            $table->foreign('branch_id', 'branch_commerces_branch_id_foreign')
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
        Schema::dropIfExists('gym_commerces');
    }
};
