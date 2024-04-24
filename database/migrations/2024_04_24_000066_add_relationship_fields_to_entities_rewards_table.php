<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEntitiesRewardsTable extends Migration
{
    public function up()
    {
        Schema::table('entities_rewards', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->foreign('entity_id', 'entity_fk_9720929')->references('id')->on('entities');
            $table->unsignedBigInteger('reward_id')->nullable();
            $table->foreign('reward_id', 'reward_fk_9720930')->references('id')->on('rewards');
        });
    }
}
