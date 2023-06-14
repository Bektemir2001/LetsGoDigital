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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->json('phone_numbers');
            $table->string('email');
            $table->string('photo')->nullable();
            $table->string('region');
            $table->string('link_gps')->nullable();
            $table->string('address')->nullable();
            $table->string('web_site')->nullable();
            $table->json('working_day')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
