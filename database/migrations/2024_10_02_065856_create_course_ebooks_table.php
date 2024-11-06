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
        Schema::create('tbl_course_ebooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('tbl_courses')->onDelete('cascade');
            $table->foreignId('ebook_id')->constrained('tbl_ebooks')->onDelete('cascade');
            $table->enum('type', ['free', 'premium']);
            $table->enum('status', ['draft', 'published']);
            $table->integer('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_course_ebooks');
    }
};
