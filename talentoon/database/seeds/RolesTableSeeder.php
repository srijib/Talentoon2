<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           DB::table('roles')->insert([
            'name' => 'audience',
            'display_name' => 'Audience',
            'description' => 'Audience as a user-role can follow Talents/Mentors, they can like,share,comment on talents posts and vote for talents in competitions',
        ]);
            DB::table('roles')->insert([
            'name' => 'talent',
            'display_name' => 'Talent',
            'description' => 'Talent as a user-role can upload posts under a certain category, follow mentors and attend workshops',
        ]);
             DB::table('roles')->insert([
            'name' => 'mentor',
            'display_name' => 'Mentor',
            'description' => 'Mentor as a user-role can follow other Talents/Mentors, they can upload their posts under a certain category and give initial reviews on talents posts, they can also announce events and workshop simnars',
        ]);
    }
}
