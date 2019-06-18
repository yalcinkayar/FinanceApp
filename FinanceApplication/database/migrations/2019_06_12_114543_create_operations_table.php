<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('operationtype')->default('0');
            $table->integer('customerid');
            $table->integer('billingid')->default('0');
            $table->double('price');
            $table->date('date');
            $table->integer('bankid');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
