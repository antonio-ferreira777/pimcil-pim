<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEntitiesPressesTable extends Migration
{
    public function up()
    {
        Schema::table('entities_presses', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->foreign('entity_id', 'entity_fk_9720976')->references('id')->on('entities');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9720981')->references('id')->on('statuses');
        });
    }
}
