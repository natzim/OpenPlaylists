<?php

use Illuminate\Database\Seeder;
use App\Playlist;

class PlaylistTableSeeder extends Seeder {

    public function run()
    {
        DB::table('playlists')->truncate();

        $faker = Faker\Factory::create();

        for ($i = 0; $i < 200; $i++)
        {
            Playlist::create([
                'name'     => $faker->catchPhrase,
                'user_id'  => $faker->numberBetween($min = 1, $max = 50)
            ]);
        }
    }

}