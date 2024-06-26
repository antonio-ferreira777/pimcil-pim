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
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id', 'country_fk_9720549')->references('id')->on('countries');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9720985')->references('id')->on('statuses');
        });
    }
}
