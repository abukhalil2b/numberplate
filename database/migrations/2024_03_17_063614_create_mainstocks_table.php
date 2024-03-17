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
        Schema::create('mainstocks', function (Blueprint $table) {
            $table->id();
            
            $table->string('cate',25);//plate - extra (frame) - purfume

            $table->string('type',20)->nullable();//private - commercial - diplomatic - temporary - export - specific - government - other
            
            $table->boolean('instock')->default(true);//true - false => add - subtrac

            $table->string('size',25)->nullable();//small-plate - medium-plate - large-plate - large-plate-with-khanjer - extra 
           
            $table->mediumInteger('quantity')->default(1);
 
            $table->unsignedBigInteger('supplier_id')->nullable();  
            $table->foreign('supplier_id')->references('id')->on('suppliers')->cascadeOnDelete();
            
            $table->text('description')->nullable();//

            $table->date('issue_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mainstocks');
    }
};
