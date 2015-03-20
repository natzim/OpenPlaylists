<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 100); // YouTube video titles are limited to 100 characters
            $table->integer('playlist_id')->unsigned();
            $table->string('youtube_id', 11); // YouTube IDs are 11 characters long
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }

}
