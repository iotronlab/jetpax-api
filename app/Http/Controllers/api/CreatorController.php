<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CreatorResource;
use App\Http\Resources\CreatorShowResource;
use App\Models\Creator;
use App\Scoping\Scopes\CategoriesScope;
use App\Scoping\Scopes\FollowersScope;
use App\Scoping\Scopes\LanguagesScope;
use App\Scoping\Scopes\SocialScope;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CreatorResource::collection(
            Creator::withScopes($this->scopes())->paginate(10)
        );
        // $value ="Twitter";
        // return Creator::where('socials','like','%'.$value.'%')->get();
    }

    protected function scopes()
    {
        return [
            'followers'     => new FollowersScope(),
            'languages'     => new LanguagesScope(),
            'categories'    => new CategoriesScope(),
            'social'        => new SocialScope(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function show(Creator $creator)
    {
        //
        return new CreatorShowResource(
            $creator
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function edit(Creator $creator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Creator $creator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Creator  $creator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creator $creator)
    {
        //
    }
}
