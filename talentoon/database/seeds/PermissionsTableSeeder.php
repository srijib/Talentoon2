<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'create-comment',
            'display_name' => 'Write a Comment',
            'description' => 'Normal Audience can comment under a certain post,event'
        ]);
         DB::table('permissions')->insert([
            'name' => 'delete-comment',
            'display_name' => 'Delete a Comment',
            'description' => 'Normal Audience can delete a comment under a certain post,event'
        ]);
              DB::table('permissions')->insert([
            'name' => 'create-post',
            'display_name' => 'Write A Post',
            'description' => 'Mentor or Talent can write a post under a certain category'
        ]);
              DB::table('permissions')->insert([
            'name' => 'create-workshop',
            'display_name' => 'Create Workshop',
            'description' => 'Mentor can create workshop under a certain category'
        ]);
              DB::table('permissions')->insert([
            'name' => 'create-event',
            'display_name' => 'Create an Event',
            'description' => 'Mentor can create an event under a certain category'
        ]);
                 
    }
}
