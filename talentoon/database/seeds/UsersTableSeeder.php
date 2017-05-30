<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'first_name' => 'mina',
            'last_name' => 'zakaria',
            'email' => 'mina@yahoo.com',
            'gender' => 'male',
            'phone' => '01203370083',
            'date_of_birth' => '2017-01-01',
            'country_id' => 1,
            'image' => 'uploads/profile_pic/face1.jpg',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'first_name' => 'nada',
            'last_name' => 'bayoumy',
            'email' => 'nada@yahoo.com',
            'gender' => 'female',
            'phone' => '01203370084',
            'date_of_birth' => '2016-01-01',
            'country_id' => 1,
            'image' => 'uploads/profile_pic/face2.jpg',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'first_name' => 'esraa',
            'last_name' => 'hadary',
            'email' => 'esraa@yahoo.com',
            'gender' => 'female',
            'phone' => '01203370085',
            'date_of_birth' => '2015-01-01',
            'country_id' => 1,
            'image' => 'uploads/profile_pic/face3.jpg',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'first_name' => 'simona',
            'last_name' => 'soliman',
            'email' => 'simona@yahoo.com',
            'gender' => 'female',
            'phone' => '01203370086',
            'date_of_birth' => '2018-01-01',
            'country_id' => 1,
            'image' => 'uploads/profile_pic/face4.jpg',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'first_name' => 'nahla',
            'last_name' => 'magdy',
            'email' => 'nahla@yahoo.com',
            'gender' => 'female',
            'phone' => '01203370086',
            'date_of_birth' => '2014-01-01',
            'country_id' => 1,
            'image' => 'uploads/profile_pic/face5.jpg',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'first_name' => 'bassant',
            'last_name' => 'ahmed',
            'email' => 'bassant@yahoo.com',
            'gender' => 'female',
            'phone' => '01203370087',
            'date_of_birth' => '2017-01-01',
            'country_id' => 1,
            'image' => 'uploads/profile_pic/face6.jpg',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'first_name' => 'rania',
            'last_name' => 'atef',
            'email' => 'rania@yahoo.com',
            'gender' => 'female',
            'phone' => '01203370088',
            'date_of_birth' => '2016-01-01',
            'country_id' => 1,
            'image' => 'uploads/profile_pic/face7.jpg',
            'password' => bcrypt('123456'),
        ]);
    }
}
