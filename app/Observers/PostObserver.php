<?php

namespace App\Observers;

use App\Models\Portfolio\Post;

class PostObserver
{
    public function deleting(Post $post)
    {
        $post->attachment->each->delete();
    }
}
