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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();            
            $table->string('fullname')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->mediumText('address')->nullable();
            $table->string('gender')->nullable();
            $table->date('join_date')->nullable();
            $table->integer('points')->default(0);
            $table->double('total_spent', 30,2)->default(0);
            $table->double('due',30,2)->default(0);
            $table->date('last_purchase_date')->nullable();
            $table->mediumText('notes')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1: Active, 0: Inactive');
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
        Schema::dropIfExists('customers');
    }
};
