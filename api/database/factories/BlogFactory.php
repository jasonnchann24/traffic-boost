<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $filename = time() . "_" . preg_replace('/\s+/', '_', Str::slug($title) . Str::random(3) . '.jpg');

        $image = Storage::disk('public')
            ->putFileAs('blog/meta-images', storage_path('app/seeder-images/blog/meta-images/dummymeta.jpg'), $filename);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->paragraph(),
            'description' => $this->faker->sentence(),
            'meta_tags' => [
                'meta_title' => 'meta ' . $title,
                'meta_description' => 'meta description ' . $title,
                'meta_image' => $image
            ]
        ];
    }
}
