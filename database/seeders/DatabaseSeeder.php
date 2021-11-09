<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\MstGameSeeder;
use Database\Seeders\MstStyleSeeder;
use Database\Seeders\CreateUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MstGameSeeder::class,
            MstStyleSeeder::class,
            CreateUserSeeder::class,
        ]);
    }
}
