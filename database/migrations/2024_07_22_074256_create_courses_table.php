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
            $table->string('category', 255);
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->text('cover')->nullable();
            $table->enum('type', ['free', 'premium']);
            $table->enum('status', ['draft', 'published']);
            $table->integer('price');
            $table->enum('level', ['beginner', 'intermediate', 'expert']);
            $table->text('description')->nullable();
            $table->text('resources')->nullable();
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreignId('mentor_id')->constrained('users')->onDelete('cascade');
            
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