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
        Schema::create('tbl_courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->text('cover')->nullable(false);
            $table->enum('type', ['free', 'premium'])->nullable(false);
            $table->enum('status', ['draft', 'publised'])->nullable(false);
            $table->integer('price')->nullable(false);
            $table->enum('level', ['beginner', 'intermediate', 'expert'])->nullable(false);
            $table->text('description')->nullable(true);
            $table->unsignedBigInteger('mentor_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_courses');
    }
};