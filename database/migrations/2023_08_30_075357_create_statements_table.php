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
        Schema::create('statements', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('bill_id')->nullable(); // can be null in case bought purfume 
            $table->foreign('bill_id')->references('id')->on('bills')->cascadeOnDelete();
            
            $table->string('using',50)->default('ROP');//TRANSPORTATION - ROP

            $table->string('type',20)->default('private');//private - commercial - diplomatic - temporary - export - specific - government - other
            
            $table->string('size',25)->nullable();//small-plate - medium-plate - large-plate - large-plate-with-khanjer - extra 

            $table->string('required',10)->default('pair');//single - pair
            
            $table->string('plate_num',20)->nullable();
            
            $table->string('plate_code',20)->nullable();
            
            $table->string('ref_num',30)->nullable();
            
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('users')->cascadeOnDelete();
            
            $table->date('issue_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statements');
    }
};
