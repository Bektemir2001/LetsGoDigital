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
        Schema::create('question_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->text('comment');
            $table->timestamps();

            $table->index('user_id', 'question_comment_user_idx');
            $table->index('question_id', 'question_comment_question_idx');

            $table->foreign('user_id', 'question_comment_user_fk')
                ->on('users')
                ->references('id');
            $table->foreign('question_id', 'question_comment_question_fk')
                ->on('questions')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_comments');
    }
};
