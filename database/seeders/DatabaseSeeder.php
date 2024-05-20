<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service; // Make sure to import the Service model with the correct namespace
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // User::factory(10)->create();

        // $this->call([
        //     ServiceCatagorySeeder::class
        // ]);

        Service::factory(20)->create(); // Use the correct namespace for the Service model
    }
}
