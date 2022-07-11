<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersContactFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender', '1')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('phone2', 30)->nullable();
            $table->string('zipcode', 15)->nullable();
            $table->string('address', 300)->nullable();
            $table->string('number',40)->nullable();
            $table->string('complement',140)->nullable();
            $table->string('district',140)->nullable();
            $table->string('city',140)->nullable();
            $table->string('state',140)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('paid');

            $table->dropColumn('gender');
            $table->dropColumn('birth_date');
            $table->dropColumn('cpf');
            $table->dropColumn('rg');
            $table->dropColumn('phone');
            $table->dropColumn('phone2');
            $table->dropColumn('zipcode');
            $table->dropColumn('address');
            $table->dropColumn('number');
            $table->dropColumn('complement');
            $table->dropColumn('district');
            $table->dropColumn('city');
            $table->dropColumn('state');

        });
    }
}
