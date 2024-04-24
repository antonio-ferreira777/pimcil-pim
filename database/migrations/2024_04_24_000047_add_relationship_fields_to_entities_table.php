<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEntitiesTable extends Migration
{
    public function up()
    {
        Schema::table('entities', function (Blueprint $table) {
            $table->unsignedBigInteger('taxonomy_id')->nullable();
            $table->foreign('taxonomy_id', 'taxonomy_fk_9719816')->references('id')->on('taxonomies');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id', 'type_fk_9719913')->references('id')->on('entities_types');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9719756')->references('id')->on('teams');
            $table->unsignedBigInteger('language_id')->nullable();
            $table->foreign('language_id', 'language_fk_9719757')->references('id')->on('languages');
        });
    }
}
