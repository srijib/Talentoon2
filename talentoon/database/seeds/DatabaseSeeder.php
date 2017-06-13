<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(WorkshopsTableSeeder::class);
        $this->call(LikableTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(RewardsTableSeeder::class);
        $this->call(CompetitionsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
    }
}
