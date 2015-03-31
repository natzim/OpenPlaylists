<?php

use Illuminate\Database\Seeder;
use App\Song;

class SongTableSeeder extends Seeder {

    public function run()
    {
        DB::table('songs')
          ->truncate();

        $faker = Faker\Factory::create();

        $ids = [
            'R6b-NkRAGlg',
            'riEP7ni0Ejk',
            'UXH3YKOUeC8',
            'fhR771660LE',
            'PAvdqEsobaw',
            '506NS0tDylw',
            'bw_GhedOX70',
            'HIBeNjcHhsk',
            'pZdfuuGMXdo',
            'JgYTvdzXxaU',
            'jjokYh3VUYc',
            'aN7Zx2WX2-M',
            'Om8pgDzXR3U',
            'rvZNRrwkA2c'
        ];

        for ($i = 0; $i < 1000; $i++)
        {
            Song::create([
                'name'        => $faker->name . ' - ' . $faker->company,
                'playlist_id' => $faker->numberBetween($min = 1, $max = 200),
                'youtube_id'  => $ids[array_rand($ids)]
            ]);
        }
    }

}