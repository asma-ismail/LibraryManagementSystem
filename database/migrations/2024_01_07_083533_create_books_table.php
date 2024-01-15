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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('genre_id');
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->string('author');
            $table->string('ISBN');
            $table->string('language');
            $table->string('cover')->default('no_cover.jpg');
            $table->unsignedBigInteger('membership_id');
            $table->foreign('membership_id')->references('id')->on('memberships');
            $table->string('publisher');
            $table->date('date_of_publication');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
