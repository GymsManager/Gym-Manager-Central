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
        Schema::create('branch_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('pinterest')->nullable();
            $table->timestamps();

            $table->foreign('branch_id', 'branch_contacts_branch_id_foreign')
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
        Schema::dropIfExists('branch_contacts');
    }
};
