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
        Schema::create('instructions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('category_id');
            $table->text('instruction');
            $table->timestamps();

            $table->index('category_id', 'instruction_category_idx');
            $table->foreign('category_id', 'instruction_category_fk')
                ->on('categories')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructions');
    }
};
