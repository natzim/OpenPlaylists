<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenreTableSeeder extends Seeder {

    public function run()
    {
        DB::table('genres')->truncate();

        $genres = [
            'electronic' => [
                'ambient' => [
                    'ambient dub',
                    'industrial ambient',
                    'dark ambient',
                    'drone',
                    'isolationism',
                ],
                'breakbeat' => [
                    'acid breaks',
                    'baltimore club',
                    'big beat',
                    'broken beat',
                    'jersey club',
                    'nu skool breaks',
                    'florida breaks' => [
                        'nu-funk',
                        'miami bass',
                    ],
                ],
                'disco' => [
                    'cosmic disco',
                    'disco polo',
                    'euro disco',
                    'italo disco',
                    'space disco',
                ],
                'downtempo' => [
                    'acid jazz',
                    'chill-out',
                    'flamenco chill',
                    'ethnic electronic',
                    'psybient',
                    'new-age',
                    'trip hop',
                ],
                'drum and bass' => [
                    'darkstep',
                    'drill and bass',
                    'drumstep',
                    'funkstep',
                    'hardstep',
                    'jazzstep',
                    'jump-up',
                    'liquid funk',
                    'neurofunk',
                    'sambass',
                    'techstep' => [
                        'skulls',
                    ],
                ],
                'electro' => [
                    'freestyle',
                ],
                'electroacoustic' => [
                    'acousmatic',
                    'musique concrète',
                ],
                'electronic rock' => [
                    'coldwave',
                    'dance-punk',
                    'dark wave',
                    'electroclash',
                    'electronicore',
                    'ethereal wave',
                    'krautrock',
                    'new rave',
                    'nu-gaze',
                    'space rock',
                    'synthpop',
                    'synthpunk',
                    'alternative dance' => [
                        'indietronica',
                    ],
                ],
                'electronica' => [
                    'berlin school',
                    'dubtronica',
                    'folktronica',
                    'funktronica',
                    'laptronica',
                    'livetronica',
                    'chillwave' => [
                        'vaporwave',
                    ],
                ],
                'hardcore' => [
                    '4-beat',
                    'breakbeat hardcore',
                    'bouncy techno',
                    'breakcore',
                    'digital hardcore',
                    'darkcore',
                    'gabber',
                    'happy hardcore',
                    'speedcore',
                    'terrorcore',
                    'trancecore',
                    'uk hardcore',
                    'mákina' => [
                        'melbourne bounce',
                    ],
                ],
                'hardstyle' => [
                    'dubstyle',
                    'jumpstyle',
                    'lento violento',
                    'rawstyle',
                ],
                'hi-nrg' => [
                    'eurobeat',
                    'eurodance' => [
                        'bubblegum dance',
                        'italo dance',
                    ],
                ],
                'house' => [
                    'acid house',
                    'ambient house',
                    'balearic beat',
                    'chicago house',
                    'deep house',
                    'diva house',
                    'dream house',
                    'euro house',
                    'french house',
                    'funky house',
                    'garage house',
                    'glitch house',
                    'hardbag',
                    'hip house',
                    'italo house',
                    'jazz house',
                    'kwaito',
                    'latin house',
                    'microhouse',
                    'new beat',
                    'nu-disco',
                    'outsider house',
                    'progressive house',
                    'swing house',
                    'tech house',
                    'tribal house',
                    'tropical house',
                    'witch house',
                    'electro house' => [
                        'big room',
                        'complextro',
                        'dutch house',
                        'fidget house',
                        'moombahton' => [
                            'moombahcore',
                        ],
                    ],
                    'ghetto house' => [
                        'ghettotech',
                    ],
                    'hard house' => [
                        'hard bounce',
                        'hard dance',
                        'hard nrg',
                        'nu-nrg',
                    ],
                ],
                'industrial' => [
                    'aggrotech',
                    'cybergrind',
                    'electro-industrial',
                    'dark electro',
                    'electronic body',
                    'futurepop',
                    'industrial metal',
                    'industrial rock',
                    'japanoise',
                    'neue deutsche härte',
                    'power noise',
                    'power electronics' => [
                        'death industrial',
                    ],
                ],
                'idm' => [
                    'glitch',
                    'wonky',
                ],
                'jungle' => [
                    'darkcore jungle',
                    'raggacore',
                    'ragga-jungle',
                ],
                'post-disco' => [
                    'boogie',
                    'electropop',
                    'dance-pop',
                    'dance-rock',
                ],
                'techno' => [
                    'acid techno',
                    'detroit techno',
                    'dub techno',
                    'free tekno',
                    'hardtechno',
                    'minimal techno',
                    'nortec',
                    'schranz',
                    'tecno brega',
                    'techdombe',
                ],
                'trance' => [
                    'acid trance',
                    'dream trance',
                    'goa trance',
                    'hard trance',
                    'ibiza trance',
                    'nitzhonot',
                    'progressive trance',
                    'tech trance',
                    'uplifting trance',
                    'vocal trance',
                    'melodic trance',
                    'classic trance',
                    'epic trance',
                    'psychedelic trance' => [
                        'dark psytrance',
                        'full on',
                        'psybreaks',
                        'suomisaundi',
                        'psybient',
                    ],
                ],
                'uk garage' => [
                    'breakstep',
                    'future garage',
                    'uk funky',
                    '2-step garage' => [
                        'dubstep' => [
                            'brostep',
                            'purple sound',
                        ],
                    ],
                    'grime' => [
                        'grindie',
                    ],
                    'speed garage' => [
                        'bassline',
                    ],
                ],
                'video game' => [
                    'nintendocore',
                    'skweee',
                    'chiptune' => [
                        'bitpop',
                        'game boy',
                    ],
                ],
            ],
        ];

        $this->createGenres($genres);
    }

    private function createGenres($genres, $parentGenre = null)
    {
        foreach ($genres as $key => $genre)
        {
            // If the genre has subgenres
            if (is_array($genre))
            {
                $newGenre = Genre::create([
                    'name'      => $key,
                    'parent_id' => $parentGenre
                ]);

                $this->createGenres($genre, $newGenre->id);
            }
            else
            {
                Genre::create([
                    'name'      => $genre,
                    'parent_id' => $parentGenre
                ]);
            }
        }
    }

}