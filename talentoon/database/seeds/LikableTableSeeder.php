<?php

use Illuminate\Database\Seeder;

class LikableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('likeables')->insert([
            'user_id' => '1',
            'likeable_id' => '1',
            'likeable_type' => 'post',
            'liked' => '1',
        ]);
        DB::table('likeables')->insert([
            'user_id' => '2',
            'likeable_id' => '1',
            'likeable_type' => 'post',
            'liked' => '1',
        ]);
        DB::table('likeables')->insert([
            'user_id' => '3',
            'likeable_id' => '1',
            'likeable_type' => 'post',
            'liked' => '1',
        ]);
        DB::table('likeables')->insert([
            'user_id' => '4',
            'likeable_id' => '1',
            'likeable_type' => 'post',
            'liked' => '1',
        ]);
        DB::table('likeables')->insert([
            'user_id' => '5',
            'likeable_id' => '1',
            'likeable_type' => 'post',
            'liked' => '1',
        ]);
        DB::table('likeables')->insert([
            'user_id' => '6',
            'likeable_id' => '1',
            'likeable_type' => 'post',
            'liked' => '1',
        ]);
        DB::table('likeables')->insert([
            'user_id' => '7',
            'likeable_id' => '1',
            'likeable_type' => 'post',
            'liked' => '1',
        ]);
        DB::table('likeables')->insert([
            'user_id' => '1',
            'likeable_id' => '2',
            'likeable_type' => 'post',
            'liked' => '1',
        ]);
        DB::table('likeables')->insert([
            'user_id' => '1',
            'likeable_id' => '3',
            'likeable_type' => 'post',
            'liked' => '1',
        ]);
        DB::table('likeables')->insert([
            'user_id' => '2',
            'likeable_id' => '3',
            'likeable_type' => 'post',
            'liked' => '1',
        ]);
        DB::table('likeables')->insert([
            'user_id' => '3',
            'likeable_id' => '3',
            'likeable_type' => 'post',
            'liked' => '1',
        ]);
        DB::table('likeables')->insert([
            'user_id' => '4',
            'likeable_id' => '3',
            'likeable_type' => 'post',
            'liked' => '1',
        ]);
    }
}
