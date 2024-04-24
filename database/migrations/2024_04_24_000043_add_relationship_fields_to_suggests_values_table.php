<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSuggestsValuesTable extends Migration
{
    public function up()
    {
        Schema::table('suggests_values', function (Blueprint $table) {
            $table->unsignedBigInteger('suggest_id')->nullable();
            $table->foreign('suggest_id', 'suggest_fk_9719725')->references('id')->on('suggests');
            $table->unsignedBigInteger('language_id')->nullable();
            $table->foreign('language_id', 'language_fk_9719727')->references('id')->on('languages');
        });
    }
}
