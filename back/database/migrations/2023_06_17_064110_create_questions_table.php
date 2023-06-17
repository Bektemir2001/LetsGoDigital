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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('question');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->index('category_id', 'question_category_idx');
            $table->index('user_id', 'question_user_idx');
            $table->foreign('category_id', 'question_category_fk')
                ->on('categories')
                ->references('id');
            $table->foreign('user_id', 'question_user_fk')
                ->on('users')
                ->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
