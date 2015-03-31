<?php

use Illuminate\Database\Seeder;
use App\Song;
use App\Playlist;

class SongTableSeeder extends Seeder {

    public function run()
    {
        DB::table('songs')->truncate();

        $songs = [
            [
                'name'       => 'Kill Paris - Keep Your Secrets In Midnight City',
                'youtube_id' => 'R6b-NkRAGlg'
            ],
            [
                'name'       => 'Rameses B - Game Of Thrones',
                'youtube_id' => 'riEP7ni0Ejk'
            ],
            [
                'name'       => 'AZEDIA - Something',
                'youtube_id' => 'UXH3YKOUeC8'
            ],
            [
                'name'       => 'Mr FijiWiji - Let The Sky Fall Down',
                'youtube_id' => 'fhR771660LE'
            ],
            [
                'name'       => 'Florence And The Machine - Cosmic Love (Seven Lions Remix)',
                'youtube_id' => 'PAvdqEsobaw'
            ],
            [
                'name'       => 'Above & Beyond - You Got To Go (Seven Lions Dubstep Remix)',
                'youtube_id' => '506NS0tDylw'
            ],
            [
                'name'       => 'Arkasia - Pandemonium',
                'youtube_id' => 'bw_GhedOX70'
            ],
            [
                'name'       => 'Qualmsound - Breath (Blynk Remix)',
                'youtube_id' => 'HIBeNjcHhsk'
            ],
            [
                'name'       => 'Sorrow & Shura - Thinking Of You',
                'youtube_id' => 'pZdfuuGMXdo'
            ],
            [
                'name'       => 'Two Thirds & Feint - Epiphany (feat. Veela) (Ghosts Of Paraguay Remix)',
                'youtube_id' => 'JgYTvdzXxaU'
            ],
            [
                'name'       => 'Subscape - Apple Candy',
                'youtube_id' => 'jjokYh3VUYc'
            ],
            [
                'name'       => 'Mario M - Acid Rain feat. Epp Kõiv',
                'youtube_id' => 'aN7Zx2WX2-M'
            ],
            [
                'name'       => 'Ghosts Of Paraguay - The River feat. Aiden Dullaghan',
                'youtube_id' => 'Om8pgDzXR3U'
            ],
            [
                'name'       => 'Ghosts Of Paraguay - Piano Piece',
                'youtube_id' => 'rvZNRrwkA2c'
            ]
        ];

        // Create individual songs
        for ($i = 0; $i < count($songs); $i++)
        {
            $song = $songs[array_rand($songs)];

            Song::create([
                'name'       => $song['name'],
                'youtube_id' => $song['youtube_id']
            ]);
        }

        // Attach them to playlists
        for ($j = 0; $j < 1000; $j++)
        {
            $song     = Song::find(rand(1, count($songs)));
            $playlist = Playlist::find(rand(1, 200));

            $song->playlists()->save($playlist);
        }
    }

}