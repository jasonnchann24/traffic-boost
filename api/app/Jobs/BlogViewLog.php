<?php

namespace App\Jobs;

use App\Models\Blog;
use App\Models\BlogView;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlogViewLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $blog;
    private $log;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Blog $blog, array $log)
    {
        $this->blog = $blog;
        $this->log = $log;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $blogViews = $this->blog->blogViews();
        $isExists = $blogViews->exists()
            ? $blogViews->where('ip', $this->log['ip'])->first()
            : false;

        if (!$isExists) {
            BlogView::create($this->log);
            $this->blog->view_counts += 1;
            $this->blog->save();
        }
    }
}
