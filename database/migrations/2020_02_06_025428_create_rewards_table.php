<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('rewards');
        Schema::create('rewards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('camp_id')->unsigned();
            $table->string('name',255);
            $table->string('description',255)->nullable();
            $table->string('notes',255)->nullable();
            $table->decimal('reward_min')->nullable();
            $table->decimal('reward_max')->nullable();
            $table->integer('number_available')->nullable();
            $table->timestamps();
            $table->string('reward_min_text',255)->nullable();
            $table->foreign('camp_id')->references('id')->on('camps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewards');
    }
}
