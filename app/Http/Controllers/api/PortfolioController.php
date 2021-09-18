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
        $portfolio = Portfolio::where('status', true)->withScopes($this->scopes())->with('attachment')->paginate(10);
        return PortfolioIndexResource::collection(
            $portfolio
        );
    }


    protected function scopes()
    {
        return [
            'service'     => new ServiceScope(),

        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio\Portfolio  $portfolio
     */
    public function show(Portfolio $portfolio)
    {
        $portfolio->load('attachment', 'posts', 'posts.attachment');
        return new PortfolioShowResource($portfolio);
    }

    public function getPosts()
    {
        $posts = Post::where('status', true)->where('portfolio_id', '=', null)->with('attachment')->paginate(10);
        return PostIndexResource::collection($posts);
    }
}
