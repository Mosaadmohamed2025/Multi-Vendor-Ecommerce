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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->text('heading');
            $table->text('content');
            $table->string('image')->nullable();
            $table->integer('experience')->default(30);
            $table->integer('return_customer')->default(70);
            $table->integer('happy_customer')->default(500);
            $table->integer('award_won');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
