<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('class_parent_id')->nullable();
            $table->unsignedBigInteger('registration_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->unsignedBigInteger('instructor_id_executed')->nullable();

            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('class_type', 2)->nullable();
            $table->string('status', 2)->nullable();
            $table->text('comments')->nullable();
            $table->text('absense_comments')->nullable();

            $table->foreign('registration_id')->references('id')->on('registrations');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('instructor_id')->references('id')->on('instructors');
            $table->foreign('instructor_id_executed')->references('id')->on('instructors');
            $table->foreign('class_parent_id')->references('id')->on('classes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
