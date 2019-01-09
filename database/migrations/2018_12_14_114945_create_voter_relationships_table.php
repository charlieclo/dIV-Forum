<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoterRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voter_relationships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vote_giver')->unsigned();
            $table->foreign('vote_giver')->references('id')->on('users')->onDelete('cascade');
            $table->integer('vote_receiver')->unsigned();
            $table->foreign('vote_receiver')->references('id')->on('users')->onDelete('cascade');
            $table->integer('type'); //0 for negative, 1 for positive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voter_relationships');
    }
}
