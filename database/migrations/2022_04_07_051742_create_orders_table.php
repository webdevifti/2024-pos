<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number',20)->nullable();
            $table->integer('customer_id')->nullable();
            $table->double('total_amount',30,2)->nullable();
            $table->double('paid_amount',30,2)->nullable();
            $table->double('due',30,2)->nullable();
            $table->string('payment_method')->nullable();
            $table->float('tax_rate',10,2)->nullable();
            $table->double('tax_amount',30,2)->nullable();
            $table->float('discount_rate',20,2)->nullable();
            $table->double('discount_amount',30,2)->nullable();
            $table->string('payment_status')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
};
