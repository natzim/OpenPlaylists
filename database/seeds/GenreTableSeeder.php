<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenreTableSeeder extends Seeder {

    public function run()
    {
        DB::table('genres')->truncate();

        $genres = [
            ['name' => 'electronic', 'children' => [
                ['name' => 'ambient', 'children' => [
                    ['name' => 'ambient dub'],
                    ['name' => 'industrial ambient'],
                    ['name' => 'dark ambient'],
                    ['name' => 'drone'],
                    ['name' => 'isolationism'],
                ]],
                ['name' => 'breakbeat', 'children' => [
                    ['name' => 'acid breaks'],
                    ['name' => 'baltimore club'],
                    ['name' => 'big beat'],
                    ['name' => 'broken beat'],
                    ['name' => 'jersey club'],
                    ['name' => 'nu skool breaks'],
                    ['name' => 'florida breaks', 'children' => [
                        ['name' => 'nu-funk'],
                        ['name' => 'miami bass'],
                    ]],
                ]],
                ['name' => 'disco', 'children' => [
                    ['name' => 'cosmic disco'],
                    ['name' => 'disco polo'],
                    ['name' => 'euro disco'],
                    ['name' => 'italo disco'],
                    ['name' => 'space disco'],
                ]],
                ['name' => 'downtempo', 'children' => [
                    ['name' => 'acid jazz'],
                    ['name' => 'chill-out'],
                    ['name' => 'flamenco chill'],
                    ['name' => 'ethnic electronic'],
                    ['name' => 'psybient'],
                    ['name' => 'new-age'],
                    ['name' => 'trip hop'],
                ]],
                ['name' => 'drum and bass', 'children' => [
                    ['name' => 'darkstep'],
                    ['name' => 'drill and bass'],
                    ['name' => 'drumstep'],
                    ['name' => 'funkstep'],
                    ['name' => 'hardstep'],
                    ['name' => 'jazzstep'],
                    ['name' => 'jump-up'],
                    ['name' => 'liquid funk'],
                    ['name' => 'neurofunk'],
                    ['name' => 'sambass'],
                    ['name' => 'techstep', 'children' => [
                        ['name' => 'skulls'],
                    ]],
                ]],
                ['name' => 'electro', 'children' => [
                    ['name' => 'freestyle'],
                ]],
                ['name' => 'electroacoustic', 'children' => [
                    ['name' => 'acousmatic'],
                    ['name' => 'musique concrète'],
                ]],
                ['name' => 'electronic rock', 'children' => [
                    ['name' => 'coldwave'],
                    ['name' => 'dance-punk'],
                    ['name' => 'dark wave'],
                    ['name' => 'electroclash'],
                    ['name' => 'electronicore'],
                    ['name' => 'ethereal wave'],
                    ['name' => 'krautrock'],
                    ['name' => 'new rave'],
                    ['name' => 'nu-gaze'],
                    ['name' => 'space rock'],
                    ['name' => 'synthpop'],
                    ['name' => 'synthpunk'],
                    ['name' => 'alternative dance', 'children' => [
                        ['name' => 'indietronica'],
                    ]],
                ]],
                ['name' => 'electronica', 'children' => [
                    ['name' => 'berlin school'],
                    ['name' => 'dubtronica'],
                    ['name' => 'folktronica'],
                    ['name' => 'funktronica'],
                    ['name' => 'laptronica'],
                    ['name' => 'livetronica'],
                    ['name' => 'chillwave', 'children' => [
                        ['name' => 'vaporwave'],
                    ]],
                ]],
                ['name' => 'hardcore', 'children' => [
                    ['name' => '4-beat'],
                    ['name' => 'breakbeat hardcore'],
                    ['name' => 'bouncy techno'],
                    ['name' => 'breakcore'],
                    ['name' => 'digital hardcore'],
                    ['name' => 'darkcore'],
                    ['name' => 'gabber'],
                    ['name' => 'happy hardcore'],
                    ['name' => 'speedcore'],
                    ['name' => 'terrorcore'],
                    ['name' => 'trancecore'],
                    ['name' => 'uk hardcore'],
                    ['name' => 'mákina', 'children' => [
                        ['name' => 'melbourne bounce'],
                    ]],
                ]],
                ['name' => 'hardstyle', 'children' => [
                    ['name' => 'dubstyle'],
                    ['name' => 'jumpstyle'],
                    ['name' => 'lento violento'],
                    ['name' => 'rawstyle'],
                ]],
                ['name' => 'hi-nrg', 'children' => [
                    ['name' => 'eurobeat'],
                    ['name' => 'eurodance', 'children' => [
                        ['name' => 'bubblegum dance'],
                        ['name' => 'italo dance'],
                    ]],
                ]],
                ['name' => 'house', 'children' => [
                    ['name' => 'acid house'],
                    ['name' => 'ambient house'],
                    ['name' => 'balearic beat'],
                    ['name' => 'chicago house'],
                    ['name' => 'deep house'],
                    ['name' => 'diva house'],
                    ['name' => 'dream house'],
                    ['name' => 'euro house'],
                    ['name' => 'french house'],
                    ['name' => 'funky house'],
                    ['name' => 'garage house'],
                    ['name' => 'glitch house'],
                    ['name' => 'hardbag'],
                    ['name' => 'hip house'],
                    ['name' => 'italo house'],
                    ['name' => 'jazz house'],
                    ['name' => 'kwaito'],
                    ['name' => 'latin house'],
                    ['name' => 'microhouse'],
                    ['name' => 'new beat'],
                    ['name' => 'nu-disco'],
                    ['name' => 'outsider house'],
                    ['name' => 'progressive house'],
                    ['name' => 'swing house'],
                    ['name' => 'tech house'],
                    ['name' => 'tribal house'],
                    ['name' => 'tropical house'],
                    ['name' => 'witch house'],
                    ['name' => 'electro house', 'children' => [
                        ['name' => 'big room'],
                        ['name' => 'complextro'],
                        ['name' => 'dutch house'],
                        ['name' => 'fidget house'],
                        ['name' => 'moombahton', 'children' => [
                            ['name' => 'moombahcore'],
                        ]],
                    ]],
                    ['name' => 'ghetto house', 'children' => [
                        ['name' => 'ghettotech'],
                    ]],
                    ['name' => 'hard house', 'children' => [
                        ['name' => 'hard bounce'],
                        ['name' => 'hard dance'],
                        ['name' => 'hard nrg'],
                        ['name' => 'nu-nrg'],
                    ]],
                ]],
                ['name' => 'industrial', 'children' => [
                    ['name' => 'aggrotech'],
                    ['name' => 'cybergrind'],
                    ['name' => 'electro-industrial'],
                    ['name' => 'dark electro'],
                    ['name' => 'electronic body'],
                    ['name' => 'futurepop'],
                    ['name' => 'industrial metal'],
                    ['name' => 'industrial rock'],
                    ['name' => 'japanoise'],
                    ['name' => 'neue deutsche härte'],
                    ['name' => 'power noise'],
                    ['name' => 'power electronics', 'children' => [
                        ['name' => 'death industrial'],
                    ]],
                ]],
                ['name' => 'idm', 'children' => [
                    ['name' => 'glitch'],
                    ['name' => 'wonky'],
                ]],
                ['name' => 'jungle', 'children' => [
                    ['name' => 'darkcore jungle'],
                    ['name' => 'raggacore'],
                    ['name' => 'ragga-jungle'],
                ]],
                ['name' => 'post-disco', 'children' => [
                    ['name' => 'boogie'],
                    ['name' => 'electropop'],
                    ['name' => 'dance-pop'],
                    ['name' => 'dance-rock'],
                ]],
                ['name' => 'techno', 'children' => [
                    ['name' => 'acid techno'],
                    ['name' => 'detroit techno'],
                    ['name' => 'dub techno'],
                    ['name' => 'free tekno'],
                    ['name' => 'hardtechno'],
                    ['name' => 'minimal techno'],
                    ['name' => 'nortec'],
                    ['name' => 'schranz'],
                    ['name' => 'tecno brega'],
                    ['name' => 'techdombe'],
                ]],
                ['name' => 'trance', 'children' => [
                    ['name' => 'acid trance'],
                    ['name' => 'dream trance'],
                    ['name' => 'goa trance'],
                    ['name' => 'hard trance'],
                    ['name' => 'ibiza trance'],
                    ['name' => 'nitzhonot'],
                    ['name' => 'progressive trance'],
                    ['name' => 'tech trance'],
                    ['name' => 'uplifting trance'],
                    ['name' => 'vocal trance'],
                    ['name' => 'melodic trance'],
                    ['name' => 'classic trance'],
                    ['name' => 'epic trance'],
                    ['name' => 'psychedelic trance', 'children' => [
                        ['name' => 'dark psytrance'],
                        ['name' => 'full on'],
                        ['name' => 'psybreaks'],
                        ['name' => 'suomisaundi'],
                        ['name' => 'psybient'],
                    ]],
                ]],
                ['name' => 'uk garage', 'children' => [
                    ['name' => 'breakstep'],
                    ['name' => 'future garage'],
                    ['name' => 'uk funky'],
                    ['name' => '2-step garage', 'children' => [
                        ['name' => 'dubstep', 'children' => [
                            ['name' => 'brostep'],
                            ['name' => 'purple sound'],
                        ]],
                    ]],
                    ['name' => 'grime', 'children' => [
                        ['name' => 'grindie'],
                    ]],
                    ['name' => 'speed garage', 'children' => [
                        ['name' => 'bassline'],
                    ]],
                ]],
                ['name' => 'video game', 'children' => [
                    ['name' => 'nintendocore'],
                    ['name' => 'skweee'],
                    ['name' => 'chiptune', 'children' => [
                        ['name' => 'bitpop'],
                        ['name' => 'game boy'],
                    ]],
                ]],
            ]],
        ];

        Genre::buildTree($genres);
    }

}