<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('invoice');
            $table->date('date');
            $table->string('received_from')->nullable();
            $table->string('supplier_id')->nullable();
            $table->integer('subtotal')->nullable();
            $table->integer('dp')->nullable();
            $table->integer('remaining')->nullable();
            $table->enum('type', ['in','out']);
            $table->text('desc')->nullable();
            $table->string('branch_id');
            $table->string('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
            $table->foreign('supplier_id')
                  ->references('id')
                  ->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_transactions');
    }
}
