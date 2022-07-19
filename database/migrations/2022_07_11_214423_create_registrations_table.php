<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('status',2)->nullable();
            $table->integer('expiration_day')->nullable();
            $table->integer('class_per_week')->nullable();
            $table->decimal('value', 10,2)->nullable();
            $table->decimal('discount', 10,2)->nullable();
            $table->decimal('final_value', 10,2)->nullable();
            $table->text('comments')->nullable();
            $table->dateTime('cancel_date')->nullable();
            $table->text('cancel_comments')->nullable();

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('plan_id')->references('id')->on('plans');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
