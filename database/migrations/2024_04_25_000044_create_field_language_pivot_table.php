<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldLanguagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('field_language', function (Blueprint $table) {
            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id', 'field_id_fk_9722367')->references('id')->on('fields')->onDelete('cascade');
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id', 'language_id_fk_9722367')->references('id')->on('languages')->onDelete('cascade');
        });
    }
}
