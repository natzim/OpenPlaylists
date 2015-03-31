<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistsTable extends Migration {

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')
                  ->unsigned();
            $table->integer('fork_parent_id')
                  ->unsigned();
            $table->string('name', 100);
            $table->string('slug')
                  ->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlists');
    }

}
