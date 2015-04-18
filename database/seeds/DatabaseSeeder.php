<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
        $this->call('PlaylistTableSeeder');
        $this->call('SongTableSeeder');

        // Keep this in the last position
        // Baum re-guards all models after building a tree, so it broke the other seeders
        $this->call('GenreTableSeeder');
    }

}
