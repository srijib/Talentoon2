<?php

use Illuminate\Database\Seeder;

class CompetitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('competitions')->insert([
            'competition_start_time' => '08:21:23',
            'competition_end_time' => '11:29:30',
            'competition_start_date' => '2017-05-17',
            'competition_end_date' => '2017-05-19',
            'first_winner_talent_id' => '3',
            'second_winner_talent_id' => '4',
            'third_winner_talent_id' => '5',
            'competition_from_level' => '1',
            'competition_to_level' => '2',
            'category_id' => '1',
            'mentor_id' => '1',
            'image' => 'uploads/competitions/1.jpg',
            'title' => 'Meet The Melody',
            'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
            'points_description' => 'first 100 point & second 50 point & third 20 point',
        ]);
        DB::table('competitions')->insert([
            'competition_start_time' => '08:21:23',
            'competition_end_time' => '11:29:30',
            'competition_start_date' => '2017-05-17',
            'competition_end_date' => '2017-05-19',
            'first_winner_talent_id' => '3',
            'second_winner_talent_id' => '4',
            'third_winner_talent_id' => '5',
            'competition_from_level' => '1',
            'competition_to_level' => '2',
            'category_id' => '1',
            'mentor_id' => '1',
            'image' => 'uploads/competitions/2.jpg',
            'title' => 'Meet The Melody',
            'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
            'points_description' => 'first 100 point & second 50 point & third 20 point',
        ]);
        DB::table('competitions')->insert([
            'competition_start_time' => '08:21:23',
            'competition_end_time' => '11:29:30',
            'competition_start_date' => '2017-05-17',
            'competition_end_date' => '2017-05-19',
            'first_winner_talent_id' => '3',
            'second_winner_talent_id' => '4',
            'third_winner_talent_id' => '5',
            'competition_from_level' => '1',
            'competition_to_level' => '2',
            'category_id' => '1',
            'mentor_id' => '1',
            'image' => 'uploads/competitions/3.jpg',
            'title' => 'Meet The Melody',
            'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
            'points_description' => 'first 100 point & second 50 point & third 20 point',
        ]);
        DB::table('competitions')->insert([
            'competition_start_time' => '08:21:23',
            'competition_end_time' => '11:29:30',
            'competition_start_date' => '2017-05-17',
            'competition_end_date' => '2017-05-19',
            'first_winner_talent_id' => '3',
            'second_winner_talent_id' => '4',
            'third_winner_talent_id' => '5',
            'competition_from_level' => '1',
            'competition_to_level' => '2',
            'category_id' => '1',
            'mentor_id' => '1',
            'image' => 'uploads/competitions/4.jpg',
            'title' => 'Meet The Melody',
            'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
            'points_description' => 'first 100 point & second 50 point & third 20 point',
        ]);
        DB::table('competitions')->insert([
            'competition_start_time' => '08:21:23',
            'competition_end_time' => '11:29:30',
            'competition_start_date' => '2017-05-17',
            'competition_end_date' => '2017-05-19',
            'first_winner_talent_id' => '3',
            'second_winner_talent_id' => '4',
            'third_winner_talent_id' => '5',
            'competition_from_level' => '1',
            'competition_to_level' => '2',
            'category_id' => '1',
            'mentor_id' => '1',
            'image' => 'uploads/competitions/5.jpg',
            'title' => 'Meet The Melody',
            'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
            'points_description' => 'first 100 point & second 50 point & third 20 point',
        ]);
        DB::table('competitions')->insert([
            'competition_start_time' => '08:21:23',
            'competition_end_time' => '11:29:30',
            'competition_start_date' => '2017-05-17',
            'competition_end_date' => '2017-05-19',
            'first_winner_talent_id' => '3',
            'second_winner_talent_id' => '4',
            'third_winner_talent_id' => '5',
            'competition_from_level' => '1',
            'competition_to_level' => '2',
            'category_id' => '1',
            'mentor_id' => '1',
            'image' => 'uploads/competitions/6.jpg',
            'title' => 'Meet The Melody',
            'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
            'points_description' => 'first 100 point & second 50 point & third 20 point',
        ]);
    }
}
