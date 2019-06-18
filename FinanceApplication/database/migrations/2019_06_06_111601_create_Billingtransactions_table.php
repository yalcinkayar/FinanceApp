<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingtransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Billingtransactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('billingid');
            $table->integer('itemid');
            $table->integer('productid');
            $table->integer('amount');
            $table->double('price');
            $table->integer('tax');
            $table->double('subtotal');
            $table->double('total_taxed');
            $table->double('overalltotal');
            $table->string('text');
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
        Schema::dropIfExists('Billingtransactions');
    }
}
