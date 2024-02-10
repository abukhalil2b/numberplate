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
            $table->string('profile')->default('branch');// branch - admin 
            $table->string('ar_name')->nullable();
            $table->string('en_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone',10)->nullable();
            $table->tinyInteger('branch_id')->default(0);//user moderate branches
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('plain_password',20)->nullable();
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
