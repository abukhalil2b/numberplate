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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->string('cate', 25); //plate - extra

            // in case this item not a plate we set type nullable
            $table->string('type', 20)->nullable(); //private - commercial - diplomatic - temporary - export - specific - government - other

            $table->string('required',10)->nullable();//single - pair

            $table->string('size', 25)->nullable(); //small-plate - medium-plate - large-plate - large-plate-with-khanjer - extra 

            $table->mediumInteger('quantity')->default(1);

            $table->decimal('price', 6, 3)->default(1.000);
            //[ ] Special PHP Packages For Money

            $table->unsignedBigInteger('bill_id')->nullable(); // can be null in case bought purfume 
            $table->foreign('bill_id')->references('id')->on('bills')->cascadeOnDelete();

            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('users')->cascadeOnDelete();

            $table->string('status', 20)->nullable(); //success - failed

            $table->text('description')->nullable(); //in case bought another service -- cate = extra

            $table->date('issue_date');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
