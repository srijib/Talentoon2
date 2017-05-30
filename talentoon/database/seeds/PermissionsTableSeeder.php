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
            'description' => 'Comments can be written under a certain post,event'
        ]);
         DB::table('permissions')->insert([
            'name' => 'delete-comment',
            'display_name' => 'Delete a Comment',
            'description' => 'Comment can be deleted under a certain post,event'
        ]);
              DB::table('permissions')->insert([
            'name' => 'create-post',
            'display_name' => 'Write A Post',
            'description' => 'Writing a post should be under a certain category'
        ]);
                 
    }
}
