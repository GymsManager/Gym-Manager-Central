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
        Schema::create('branch_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->json('address')->nullable();
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->timestamps();

            $table->foreign('branch_id', 'branch_addresses_branch_id_foreign')
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
        Schema::dropIfExists('branch_addresses');
    }
};
