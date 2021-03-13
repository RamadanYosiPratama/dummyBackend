<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesses', function (Blueprint $table) {
            $table->id();
            $table->integer('covidItems_id');
            $table->integer('user_id');
            $table->integer('quantity');
            $table->integer('total');
            $table->string('status');
            $table->text('payment_url');

            $table->softDeletes();
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
        Schema::dropIfExists('sesses');
    }
}
