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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            // $table->string('cate');//خصوصي - تجاري - حكومي - دبلوماسي - تصدير - تعليم السياقة
            $table->string('num_plate')->nullable();
            $table->string('zone_plate')->nullable();
            $table->string('size_plate')->nullable();//small - medium -large - null
            $table->string('price_printing');//
            $table->string('quantity');// 1 - 2
            $table->string('ref_num')->nullable();
            $table->boolean('success_printing')->default(1);// true - false
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
