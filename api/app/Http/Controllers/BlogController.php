<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Jobs\BlogViewLog;
use App\Models\Blog;
use App\Services\AgentLogService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BlogResource::collection(Blog::latest()->paginate(50));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $validated = $request->validated();

        $imagePath = ImageService::save($request, 'blog/meta-images', "meta_image");
        unset($validated['meta_image']);

        $validated['meta_tags']['meta_image'] = $imagePath;

        $b = Blog::create($validated);
        $b->attachBlogToCategories($b, $validated['category_ids']);

        return (new BlogResource($b))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $log = AgentLogService::generateAgentLog($blog, 'blog_id');
        BlogViewLog::dispatch($blog, $log);

        return new BlogResource($blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
