<?php

use Illuminate\Database\Seeder;

class RewardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rewards')->insert([
            'first_place_competition_reward' => 'uploads/rewards/first_place.jpg',
            'second_place_competition_reward' => 'uploads/rewards/second_place.jpg',
            'third_place_competition_reward' => 'uploads/rewards/third_place.jpg',
            'first' => 'uploads/rewards/level1.jpg',
            'second' => 'uploads/rewards/level2.jpg',
            'third' => 'uploads/rewards/level3.jpg',
            'fourth' => 'uploads/rewards/level4.jpg',
            'fifth' => 'uploads/rewards/level5.jpg',
            'sixth' => 'uploads/rewards/level6.jpg',
            'seventh' => 'uploads/rewards/level7.jpg',
            'eighths' => 'uploads/rewards/level8.jpg',
            'ninth' => 'uploads/rewards/level9.jpg',
            'tenth' => 'uploads/rewards/level10.jpg',
        ]);
    }
}
