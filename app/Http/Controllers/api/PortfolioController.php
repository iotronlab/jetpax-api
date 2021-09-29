<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Portfolio\PortfolioIndexResource;
use App\Http\Resources\Portfolio\PortfolioShowResource;
use App\Http\Resources\Post\PostIndexResource;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\Post;
use App\Scoping\Scopes\ServiceScope;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $portfolio = Portfolio::where('status', true)->withScopes($this->scopes())->latest()->with('attachment')->paginate(10);
        return PortfolioIndexResource::collection(
            $portfolio
        );
    }


    protected function scopes()
    {
        return [
            'service' => new ServiceScope(),

        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio\Portfolio  $portfolio
     */
    public function show(Portfolio $portfolio)
    {
        if ($portfolio->status == true) {
            $portfolio->load('attachment', 'posts', 'posts.attachment');
            return new PortfolioShowResource($portfolio);
        } else {
            //403 error resource forbidden
            return response()->json(['message' => 'portfolio page is inactive'], 403);
        }
    }

    public function getPosts()
    {
        $posts = Post::where('status', true)->where('portfolio_id', '=', null)->latest()->with('attachment')->paginate(10);
        return PostIndexResource::collection($posts);
    }

    public function getPost(Post $post)
    {
        if ($post->status == true) {
            $post->load('attachment');
            return new PostIndexResource($post);
        } else {
            //403 error resource forbidden
            return response()->json(['message' => 'post page is inactive'], 403);
        }
    }
}
