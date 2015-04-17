<?php

use Illuminate\Database\Seeder;
use App\Playlist;
use Illuminate\Database\Eloquent\Model;

class PlaylistTableSeeder extends Seeder {

    public function run()
    {
        // Don't know why I had to call this again
        Model::unguard();

        DB::table('playlists')->truncate();

        $faker = Faker\Factory::create();

        for ($i = 0; $i < 200; $i++)
        {
            Playlist::create([
                'name'     => $faker->catchPhrase,
                'user_id'  => rand(1, 50),
                'genre_id' => rand(1, 216)
            ]);
        }
    }

}