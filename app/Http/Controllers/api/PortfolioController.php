<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Portfolio\PortfolioIndexResource;
use App\Http\Resources\Portfolio\PortfolioShowResource;
use App\Models\Portfolio\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolio = Portfolio::where('status', true)->with('attachment')->paginate(10);
        return PortfolioIndexResource::collection(
            $portfolio
        );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        $portfolio->load('attachment', 'posts', 'posts.attachment');
        return new PortfolioShowResource($portfolio);
    }
}
