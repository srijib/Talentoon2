<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'title' => 'Harmony',
            'description' => 'In music, harmony considers the process by which the composition of individual sounds, or superpositions of sounds, is analysed by hearing. Usually, this means simultaneously occurring frequencies, pitches (tones, notes), or chords.[1] The study of harmony involves chords and their constru',
            'image' => 'uploads/categories_pic/harmony.jpg',
        ]);
        DB::table('categories')->insert([
            'title' => 'Orgami',
            'description' => 'Origami (折り紙?, from ori meaning "folding", and kami meaning "paper" (kami changes to gami due to rendaku)) is the art of paper folding, which is often associated with Japanese culture. In modern usage, the word "origami" is used as an inclusive term for all folding practices, regardless of their',
            'image' => 'uploads/categories_pic/orgami.jpg',
        ]);
        DB::table('categories')->insert([
            'title' => 'Poetry',
            'description' => 'Poetry has a long history, dating back to the Sumerian Epic of Gilgamesh. Early poems evolved from folk songs such as the Chinese Shijing, or from a need to retell oral epics, as with the Sanskrit Vedas, Zoroastrian Gathas, and the Homeric epics, the Iliad and the Odyssey. ',
            'image' => 'uploads/categories_pic/poetry.jpg',
        ]);
        DB::table('categories')->insert([
            'title' => 'Portrait',
            'description' => 'A portrait is a painting, photograph, sculpture, or other artistic representation of a person, in which the face and its expression is predominant. The intent is to display the likeness, personality, and even the mood of the person. For this reason, in photography a portrait is generally n',
            'image' => 'uploads/categories_pic/portrait.jpg',
        ]);
    }
}
