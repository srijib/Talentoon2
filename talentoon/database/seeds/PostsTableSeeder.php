<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->insert([
            'title' => 'Meet the melody',
            'description' => 'Contains buttons that control the state of your post. The main states are Published, Pending Review and Draft. A Published status means the post has been published live on your blog for all to see. Pending Review means the draft is waiting for review by an editor prior to publication',
            'is_approved' => '1',
            'category_id' => '1',
            'user_id' => '1',
            'media_url' => 'uploads/posts/1.jpg',
        ]);
        DB::table('posts')->insert([
            'title' => 'The harmony tune',
            'description' => 'Contains buttons that control the state of your post. The main states are Published, Pending Review and Draft. A Published status means the post has been published live on your blog for all to see. Pending Review means the draft is waiting for review by an editor prior to publication',
            'is_approved' => '1',
            'category_id' => '1',
            'user_id' => '1',
            'media_url' => 'uploads/posts/2.jpg',
        ]);
        DB::table('posts')->insert([
            'title' => 'Feel the beat',
            'description' => 'Contains buttons that control the state of your post. The main states are Published, Pending Review and Draft. A Published status means the post has been published live on your blog for all to see. Pending Review means the draft is waiting for review by an editor prior to publication',
            'is_approved' => '1',
            'category_id' => '1',
            'user_id' => '1',
            'media_url' => 'uploads/posts/3.jpg',
        ]);
        DB::table('posts')->insert([
            'title' => 'The harmony tune',
            'description' => 'Contains buttons that control the state of your post. The main states are Published, Pending Review and Draft. A Published status means the post has been published live on your blog for all to see. Pending Review means the draft is waiting for review by an editor prior to publication',
            'is_approved' => '1',
            'category_id' => '1',
            'user_id' => '1',
            'media_url' => 'uploads/posts/4.jpg',
        ]);
        DB::table('posts')->insert([
            'title' => 'Feel the beat',
            'description' => 'Contains buttons that control the state of your post. The main states are Published, Pending Review and Draft. A Published status means the post has been published live on your blog for all to see. Pending Review means the draft is waiting for review by an editor prior to publication',
            'is_approved' => '1',
            'category_id' => '1',
            'user_id' => '1',
            'media_url' => 'uploads/posts/5.jpg',
        ]);
        DB::table('posts')->insert([
            'title' => 'Meet the melody',
            'description' => 'Contains buttons that control the state of your post. The main states are Published, Pending Review and Draft. A Published status means the post has been published live on your blog for all to see. Pending Review means the draft is waiting for review by an editor prior to publication',
            'is_approved' => '1',
            'category_id' => '1',
            'user_id' => '1',
            'media_url' => 'uploads/posts/6.jpg',
        ]);
    }
}
