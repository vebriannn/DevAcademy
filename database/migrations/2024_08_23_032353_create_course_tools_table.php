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
        Schema::create('tbl_course_tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('tbl_courses')->onDelete('cascade');
            $table->foreignId('tool_id')->constrained('tbl_tools')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_course_tools');
    }
};