<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityFieldPivotTable extends Migration
{
    public function up()
    {
        Schema::create('entity_field', function (Blueprint $table) {
            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id', 'field_id_fk_9722369')->references('id')->on('fields')->onDelete('cascade');
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id', 'entity_id_fk_9722369')->references('id')->on('entities')->onDelete('cascade');
        });
    }
}
