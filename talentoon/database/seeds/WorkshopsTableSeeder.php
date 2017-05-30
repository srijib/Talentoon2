<?php

use Illuminate\Database\Seeder;

class WorkshopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('workshops')->insert([
            'time_from' => '04:15:17',
            'time_to' => '08:00:00',
            'date_from' => '2017-05-23',
            'date_to' => '2017-05-25',
            'is_approved' => '1',
            'max_capacity' => '10',
            'level' => '1',
            'media_url' => 'uploads/workshops/1.jpg',
            'media_type' => 'image',
            'name' => 'The harmony tune',
            'category_id' => '1',
            'mentor_id' => '1',
            'description' => 'and non-profit organization, to form street patrols to monitor Portlands downtown area. Several LGBT and human rights organizations sponsored Hands Across Hawthorne in response to the attack, linking hands across the entire',
        ]);
        DB::table('workshops')->insert([
            'time_from' => '04:15:17',
            'time_to' => '08:00:00',
            'date_from' => '2017-05-23',
            'date_to' => '2017-05-25',
            'is_approved' => '1',
            'max_capacity' => '10',
            'level' => '2',
            'media_url' => 'uploads/workshops/2.jpg',
            'media_type' => 'image',
            'name' => 'The harmony tune',
            'category_id' => '1',
            'mentor_id' => '1',
            'description' => 'and non-profit organization, to form street patrols to monitor Portlands downtown area. Several LGBT and human rights organizations sponsored Hands Across Hawthorne in response to the attack, linking hands across the entire',
        ]);
        DB::table('workshops')->insert([
            'time_from' => '04:15:17',
            'time_to' => '08:00:00',
            'date_from' => '2017-05-23',
            'date_to' => '2017-05-25',
            'is_approved' => '1',
            'max_capacity' => '10',
            'level' => '3',
            'media_url' => 'uploads/workshops/3.jpg',
            'media_type' => 'image',
            'name' => 'The harmony tune',
            'category_id' => '1',
            'mentor_id' => '1',
            'description' => 'and non-profit organization, to form street patrols to monitor Portlands downtown area. Several LGBT and human rights organizations sponsored Hands Across Hawthorne in response to the attack, linking hands across the entire',
        ]);
        DB::table('workshops')->insert([
            'time_from' => '04:15:17',
            'time_to' => '08:00:00',
            'date_from' => '2017-05-23',
            'date_to' => '2017-05-25',
            'is_approved' => '1',
            'max_capacity' => '10',
            'level' => '4',
            'media_url' => 'uploads/workshops/4.jpg',
            'media_type' => 'image',
            'name' => 'The harmony tune',
            'category_id' => '1',
            'mentor_id' => '1',
            'description' => 'and non-profit organization, to form street patrols to monitor Portlands downtown area. Several LGBT and human rights organizations sponsored Hands Across Hawthorne in response to the attack, linking hands across the entire',
        ]);
        DB::table('workshops')->insert([
            'time_from' => '04:15:17',
            'time_to' => '08:00:00',
            'date_from' => '2017-05-23',
            'date_to' => '2017-05-25',
            'is_approved' => '1',
            'max_capacity' => '10',
            'level' => '5',
            'media_url' => 'uploads/workshops/5.jpg',
            'media_type' => 'image',
            'name' => 'The harmony tune',
            'category_id' => '1',
            'mentor_id' => '1',
            'description' => 'and non-profit organization, to form street patrols to monitor Portlands downtown area. Several LGBT and human rights organizations sponsored Hands Across Hawthorne in response to the attack, linking hands across the entire',
        ]);
    }
}
