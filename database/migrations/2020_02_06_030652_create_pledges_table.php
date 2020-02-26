<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePledgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pledges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('camp_id')->unsigned();
            $table->integer('reward_id')->unsigned()->nullable();
            $table->decimal('amount',8,2);
            $table->string('status',255)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('camp_id')->references('id')->on('camps');
            $table->foreign('reward_id')->references('id')->on('rewards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pledges');
    }
}
