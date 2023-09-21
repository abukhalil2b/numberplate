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

            $table->boolean('instock')->default(true);//true - false

            $table->string('size',25)->nullable();//small-plate - medium-plate - large-plate - large-plate-with-khanjer - extra 
           
            $table->mediumInteger('quantity')->default(1);
 
            $table->unsignedBigInteger('branch_id');
            
            $table->foreign('branch_id')->references('id')->on('users')->cascadeOnDelete();

            $table->text('description')->nullable();//

            $table->string('note',10)->default('received');//received - transfer - sold

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
