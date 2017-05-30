<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('events')->insert([
            'time_from' => '08:21:23',
            'time_to' => '11:29:30',
            'date_from' => '2017-05-17',
            'date_to' => '2017-05-19',
            'is_approved' => '1',
            'is_paid' => '0',
            'category_id' => '1',
            'mentor_id' => '1',
            'media_url' => 'uploads/events/5.jpg',
            'media_type' => 'image',
            'title' => 'Meet The Melody',
            'location' => 'Jozwitte Art Place,Cleoptra,Alexandria',
            'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
        ]);
        DB::table('events')->insert([
            'time_from' => '08:21:23',
            'time_to' => '11:29:30',
            'date_from' => '2017-05-17',
            'date_to' => '2017-05-19',
            'is_approved' => '1',
            'is_paid' => '0',
            'category_id' => '1',
            'mentor_id' => '1',
            'media_url' => 'uploads/events/1.jpg',
            'media_type' => 'image',
            'location' => 'Jozwitte Art Place,Cleoptra,Alexandria',
            'title' => 'Meet The Melody',
            'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
        ]);
        DB::table('events')->insert([
            'time_from' => '08:21:23',
            'time_to' => '11:29:30',
            'date_from' => '2017-05-17',
            'date_to' => '2017-05-19',
            'is_approved' => '1',
            'is_paid' => '0',
            'category_id' => '1',
            'mentor_id' => '1',
            'media_url' => 'uploads/events/2.jpg',
            'media_type' => 'image',
            'location' => 'Jozwitte Art Place,Cleoptra,Alexandria',
            'title' => 'Meet The Melody',
            'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
        ]);
        DB::table('events')->insert([
            'time_from' => '08:21:23',
            'time_to' => '11:29:30',
            'date_from' => '2017-05-17',
            'date_to' => '2017-05-19',
            'is_approved' => '1',
            'is_paid' => '0',
            'category_id' => '1',
            'mentor_id' => '1',
            'media_url' => 'uploads/events/3.jpg',
            'media_type' => 'image',
            'location' => 'Jozwitte Art Place,Cleoptra,Alexandria',
            'title' => 'Meet The Melody',
            'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
        ]);
        DB::table('events')->insert([
            'time_from' => '08:21:23',
            'time_to' => '11:29:30',
            'date_from' => '2017-05-17',
            'date_to' => '2017-05-19',
            'is_approved' => '1',
            'is_paid' => '0',
            'category_id' => '1',
            'mentor_id' => '1',
            'media_url' => 'uploads/events/4.jpg',
            'media_type' => 'image',
            'location' => 'Jozwitte Art Place,Cleoptra,Alexandria',
            'title' => 'Meet The Melody',
            'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
        ]);
        DB::table('events')->insert([
            'time_from' => '08:21:23',
            'time_to' => '11:29:30',
            'date_from' => '2017-05-17',
            'date_to' => '2017-05-19',
            'is_approved' => '1',
            'is_paid' => '0',
            'category_id' => '1',
            'mentor_id' => '1',
            'media_url' => 'uploads/events/4.jpg',
            'media_type' => 'image',
            'location' => 'Jozwitte Art Place,Cleoptra,Alexandria',
            'title' => 'Meet The Melody',
            'description' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.',
        ]);
    }
}
