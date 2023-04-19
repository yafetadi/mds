<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transaction_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('stock_transaction_id');
            $table->string('stock_id');
            $table->integer('qty');
            $table->integer('price')->nullable();
            $table->integer('total')->nullable();
            $table->integer('ppn')->nullable();
            $table->text('desc')->nullable();
            $table->date("expired");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stock_transaction_id')
                  ->references('id')
                  ->on('stock_transactions');
            $table->foreign('stock_id')
                  ->references('id')
                  ->on('stocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_transaction_details');
    }
}
