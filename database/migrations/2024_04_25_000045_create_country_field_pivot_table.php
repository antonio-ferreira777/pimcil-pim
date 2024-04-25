<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryFieldPivotTable extends Migration
{
    public function up()
    {
        Schema::create('country_field', function (Blueprint $table) {
            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id', 'field_id_fk_9722368')->references('id')->on('fields')->onDelete('cascade');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id', 'country_id_fk_9722368')->references('id')->on('countries')->onDelete('cascade');
        });
    }
}
