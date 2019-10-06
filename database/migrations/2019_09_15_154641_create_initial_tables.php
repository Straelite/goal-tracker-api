<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('title');
            $table->longText('body');
            $table->boolean('completed')->default(false);
            $table->dateTime('friendly_updated_at');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('progress', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('goal_id');
            $table->string('title');
            $table->longText('body');
            $table->boolean('completed')->default(false);
            $table->dateTime('friendly_updated_at');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('steps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('progress_id');
            $table->string('title');
            $table->longText('body');
            $table->boolean('completed')->default(false);
            $table->dateTime('friendly_updated_at');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('body');
            $table->string('parent_type');
            $table->bigInteger('parent_id');
            $table->dateTime('friendly_updated_at');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('goal_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source_goal_id');
            $table->string('related_goal_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goals');
        Schema::dropIfExists('steps');
        Schema::dropIfExists('progress');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('goal_relations');
    }
}
