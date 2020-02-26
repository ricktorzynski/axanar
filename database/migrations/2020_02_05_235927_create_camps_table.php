<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->string('web_url',255);
            $table->string('image_url',255);
            $table->string('provider',255);
            $table->decimal('goal_amount',8,2);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status',255);
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
        Schema::dropIfExists('camps');
    }
}
