<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;

class FakeBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        for ($i = 0; $i < 20; $i++) {
            $randomC = $categories->random(random_int(1, 3))->pluck('id')->toArray();
            $b = Blog::factory([
                'category_ids' => $randomC
            ])->create();

            foreach ($b->category_ids as $id) {
                $category = Category::find($id);
                $category->blogs()->attach($b->id);
            }
        }
    }
}
