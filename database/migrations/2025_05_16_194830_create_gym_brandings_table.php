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
        Schema::create('gym_brandings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gym_id');
            $table->string('main_color')->nullable();
            $table->string('second_color')->nullable();
            $table->string('cover')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();

            $table->foreign('gym_id', 'gym_brandings_gym_id_foreign')
                ->references('id')->on('gyms')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_brandings');
    }
};
