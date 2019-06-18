<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customerType')->default('0');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('photo')->nullable();
            $table->string('tc')->nullable();
            $table->string('companyname')->nullable();
            $table->string('taxnumber')->nullable();
            $table->string('taxadministration')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
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
}
