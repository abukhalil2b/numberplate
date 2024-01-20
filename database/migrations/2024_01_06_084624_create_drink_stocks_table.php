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
        Schema::create('drink_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('cate');//lemond - orange - sprite
            $table->boolean('instock')->default(true);//true - false
            $table->mediumInteger('quantity')->default(1);// boxes number: 1 - 2 - 30 - 100
            $table->string('customer_name')->nullable();// customer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drink_stocks');
    }
};
