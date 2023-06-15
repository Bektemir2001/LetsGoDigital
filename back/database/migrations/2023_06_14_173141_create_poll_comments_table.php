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
        Schema::create('poll_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('poll_id');
            $table->text('comment');
            $table->timestamps();

            $table->index('user_id', 'poll_comment_user_idx');
            $table->index('poll_id', 'poll_comment_poll_idx');

            $table->foreign('user_id', 'poll_comment_user_fk')
                ->on('users')
                ->references('id');
            $table->foreign('poll_id', 'poll_comment_poll_fk')
                ->on('polls')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_comments');
    }
};
