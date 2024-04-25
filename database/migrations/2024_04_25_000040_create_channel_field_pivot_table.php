<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelFieldPivotTable extends Migration
{
    public function up()
    {
        Schema::create('channel_field', function (Blueprint $table) {
            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id', 'field_id_fk_9722366')->references('id')->on('fields')->onDelete('cascade');
            $table->unsignedBigInteger('channel_id');
            $table->foreign('channel_id', 'channel_id_fk_9722366')->references('id')->on('channels')->onDelete('cascade');
        });
    }
}
