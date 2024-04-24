<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEntitiesVersioningsTable extends Migration
{
    public function up()
    {
        Schema::table('entities_versionings', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->foreign('entity_id', 'entity_fk_9720290')->references('id')->on('entities');
        });
    }
}
