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
        Schema::create('petition_proponents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('petition_id');
            $table->timestamps();

            $table->index('user_id', 'proponents_user_idx');
            $table->index('petition_id', 'proponents_petition_idx');

            $table->foreign('user_id', 'proponents_user_fk')
                ->on('users')
                ->references('id');
            $table->foreign('petition_id', 'proponents_petition_fk')
                ->on('petitions')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petition_proponents');
    }
};
