<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousekeepingBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('housekeeping_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->date('date');
            $table->bigInteger('subject_id')->unsigned();
            $table->string('content');
            $table->integer('price');
            $table->string('store_name')->nullable();
            $table->bigInteger('method_id')->unsigned();
            $table->datetime('card_use_date')->nullable();
            $table->date('payment_month')->nullable();
            $table->tinyInteger('account_payment_flg')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('method_id')->references('id')->on('methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('housekeeping_books');
    }
}
