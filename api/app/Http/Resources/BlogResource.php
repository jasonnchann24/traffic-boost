<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = [
            '_id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'description' => $this->description,
            'slug' => $this->slug,
            'categories' => CategoryResource::collection($this->categories),
            'meta_tags' => $this->meta_tags,
            'dates' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'view_counts' => $this->view_counts
        ];

        $disk = Storage::disk('public');
        /** @var \Illuminate\Filesystem\FilesystemManager $disk */
        $resource['meta_tags']['meta_image'] = $disk->url($this->meta_tags['meta_image']);

        return $resource;
    }
}
