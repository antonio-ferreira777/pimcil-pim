<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFieldsTable extends Migration
{
    public function up()
    {
        Schema::table('fields', function (Blueprint $table) {
            $table->unsignedBigInteger('taxonomy_id')->nullable();
            $table->foreign('taxonomy_id', 'taxonomy_fk_9719815')->references('id')->on('taxonomies');
            $table->unsignedBigInteger('channel_id')->nullable();
            $table->foreign('channel_id', 'channel_fk_9719927')->references('id')->on('channels');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9719770')->references('id')->on('statuses');
        });
    }
}
