<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('invoice')->nullable();
            $table->string('customer_id');
            $table->integer('subtotal')->nullable();
            $table->integer('disc')->nullable();
            $table->integer('ppn')->nullable();
            $table->integer('delivery')->nullable();
            $table->integer('grandtotal')->nullable();
            $table->integer('payment')->nullable();
            $table->enum('payment_method', ['cash','transfer','credit']);
            $table->date('due');
            $table->enum('status', ['draft','print','return'])->default('draft');
            $table->string('user_id');
            $table->bigInteger('branch_id')->unsigned();
            $table->string('return')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
            $table->foreign('branch_id')
                  ->references('id')
                  ->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
