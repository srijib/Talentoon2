<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('countries')->insert([
            'name' => 'egypt',
            'code' => '002',
        ]);
    }
}
