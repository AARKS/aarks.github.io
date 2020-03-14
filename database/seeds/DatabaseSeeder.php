<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if  (!env('IS_SEEDER_COMPLETED')) {
            $this->call(AdminSeeder::class);
            $this->call(ServiceSeeder::class);
            $this->call(IndustryCategorySeeder::class);
            $this->call(AccountCodeCategorySeeder::class);
            $this->call(ProfessionSeeder::class);
            $this->call(PermissionSeeder::class);
        } else {
            dd("Seeder Already Completed");
        }
    }
}
