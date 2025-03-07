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
        Schema::create('tbl_lessons', function (Blueprint $table) {
            $table->id();

            // foreign key
            $table->foreign('chapter_id')->references('id')->on('tbl_chapters');
            $table->unsignedBigInteger('chapter_id');

            $table->string('name', 255)->nullable(false);
            $table->string('episode', 255)->nullable(false);
            $table->text('link_video', 255)->nullable(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_lessons');
    }
};
