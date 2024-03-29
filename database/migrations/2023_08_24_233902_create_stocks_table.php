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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            
            $table->string('cate',25);//plate - extra

            $table->string('type',20);//private - commercial - diplomatic - temporary - export - specific - government - other
            
            $table->boolean('instock')->default(true);//true - false

            $table->string('size',25)->nullable();//small-plate - medium-plate - large-plate - large-plate-with-khanjer - extra 
           
            $table->mediumInteger('quantity')->default(1);
 
            $table->unsignedBigInteger('bill_id')->nullable(); // can be null in case bought purfume 
            $table->foreign('bill_id')->references('id')->on('bills')->cascadeOnDelete();
            
            $table->unsignedBigInteger('branch_id');
            
            $table->foreign('branch_id')->references('id')->on('users')->cascadeOnDelete();

            $table->boolean('main_branch')->default(0);//is this moderator branch?
            
            $table->text('description')->nullable();//

            $table->string('note',15)->default('received');//received - transferred - sold - failed

            $table->date('issue_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
