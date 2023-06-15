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
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('consumer_id');
            $table->unsignedBigInteger('plan_id');
            $table->date('date');
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->index('client_id', 'queue_client_idx');
            $table->index('consumer_id', 'queue_consumer_idx');
            $table->index('plan_id', 'queue_plan_idx');

            $table->foreign('client_id', 'queue_client_fk')
                ->on('users')
                ->references('id');
            $table->foreign('consumer_id', 'queue_consumer_fk')
                ->on('users')
                ->references('id');
            $table->foreign('plan_id', 'queue_plan_fk')
                ->on('consumer_plans')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
