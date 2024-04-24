<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesRewardsTable extends Migration
{
    public function up()
    {
        Schema::create('entities_rewards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('year');
            $table->date('date')->nullable();
            $table->float('points', 15, 2)->nullable();
            $table->longText('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
