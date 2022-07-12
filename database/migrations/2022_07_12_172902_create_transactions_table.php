<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('registration_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->date('date')->nullable();
            $table->decimal('value', 10,2)->nullable();
            $table->integer('type')->nullable();
            $table->string('description', 300)->nullable();
            $table->integer('is_payed')->nullable();
            $table->dateTime('pay_day')->nullable();


            $table->foreign('registration_id')->references('id')->on('registrations');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
