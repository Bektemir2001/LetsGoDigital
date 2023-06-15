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
        Schema::create('poll_votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('poll_id');
            $table->integer('vote_value');
            $table->timestamps();

            $table->index('user_id', 'poll_vote_user_idx');
            $table->index('poll_id', 'poll_vote_poll_idx');

            $table->foreign('user_id', 'poll_vote_user_fk')
                ->on('users')
                ->references('id');
            $table->foreign('poll_id', 'poll_vote_poll_fk')
                ->on('polls')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_votes');
    }
};