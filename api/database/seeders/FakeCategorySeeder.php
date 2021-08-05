<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FakeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'food',
            'travel',
            'finance',
            'technology',
            'health',
            'politics',

        ];

        $admin = User::where('email', 'test@test.com')->first();

        foreach ($categories as $c) {
            Category::create([
                'name' => $c,
                'slug' => Str::slug($c),
                'user_id' => $admin->id
            ]);
        }
    }
}
