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
        Schema::create('tbl_ebooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('users')->onDelete('cascade');
            $table->string('category', 255);
            $table->string('name', 255)->nullable('false');
            $table->text('slug');
            $table->enum('type', ['free', 'premium']);
            $table->enum('status', ['draft', 'published']);
            $table->integer('price')->nullable();
            $table->text('description', 255);
            $table->text('source_ebook')->nullable('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ebooks');
    }
};
