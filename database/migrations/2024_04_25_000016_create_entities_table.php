<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesTable extends Migration
{
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref')->nullable();
            $table->string('ean')->nullable();
            $table->string('name')->nullable();
            $table->integer('is_master')->nullable();
            $table->datetime('valid_from')->nullable();
            $table->datetime('valid_to')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
