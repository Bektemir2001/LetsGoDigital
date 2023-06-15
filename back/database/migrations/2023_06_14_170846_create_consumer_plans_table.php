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
        Schema::create('consumer_plans', function (Blueprint $table) {
            $table->id();
            $table->string('hours');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->index('user_id', 'plan_user_idx');
            $table->foreign('user_id', 'plan_user_fk')
                ->on('users')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumer_plans');
    }
};
