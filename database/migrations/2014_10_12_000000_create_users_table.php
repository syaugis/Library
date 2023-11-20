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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->char('gender', 1); // M or F
            $table->string('address');
            $table->string('phone_number', 20);
            // $table->boolean('loan_status')->default(false);
            $table->string('profile_image')->nullable();
            $table->string('password');
            /* Users: 0=>Admin, 1=>User*/
            $table->unsignedTinyInteger('role')->default(1);
            $table->rememberToken();
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
};
