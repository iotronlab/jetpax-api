<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioResource;
use App\Http\Resources\PortfolioShowResource;
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

        $portfolio = Portfolio::with('attachment')->paginate(10);
        return PortfolioResource::collection(
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }
}
