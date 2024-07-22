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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('name', 255)->nullable(false);
            // $table->string('username', 255)->nullable(false);
            // $table->string('re-password', 255)->nullable(false);
            $table->text('avatar')->nullable(true);
            $table->string('email', 255)->nullable(false);
            $table->string('password', 255)->nullable(false);
            $table->enum('role', ['students', 'mentor', 'superadmin'])->nullable(false);
=======
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
>>>>>>> 65f9c5bd10b71f88ebe5fa792fb3195585152ab0
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
<<<<<<< HEAD
};
=======
};
>>>>>>> 65f9c5bd10b71f88ebe5fa792fb3195585152ab0
