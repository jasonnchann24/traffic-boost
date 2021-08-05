<?php

namespace Database\Seeders;

use Database\Seeders\FakeRoleSeeder;
use Database\Seeders\FakeUserPinSeeder;
use Database\Seeders\FakeUserSeeder;
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
        $this->call([
            FakeRoleSeeder::class,
            FakeUserSeeder::class,
            FakeUserPinSeeder::class,
            FakeCategorySeeder::class,
            FakeBlogSeeder::class,
        ]);
    }
}
