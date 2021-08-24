<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Creator\CreatorIndexResource;
use App\Http\Resources\Creator\CreatorShowResource;
use App\Models\Creator\Creator;
use App\Scoping\Scopes\BudgetScope;
use App\Scoping\Scopes\CategoriesScope;
use App\Scoping\Scopes\FollowersScope;
use App\Scoping\Scopes\LanguagesScope;
use App\Scoping\Scopes\SocialScope;

class CreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $creators = Creator::with('socials')->withScopes($this->scopes())->paginate(10);

        return CreatorIndexResource::collection(
            $creators
        );
    }

    protected function scopes()
    {
        return [
            'followers'     => new FollowersScope(),
            'languages'     => new LanguagesScope(),
            'category'    => new CategoriesScope(),
            'social'        => new SocialScope(),
            'budget'        => new BudgetScope()
        ];
    }


    /**
     * Display the specified resource.
     *
     */
    public function show(Creator $creator)
    {
        $creator->load('socials', 'services');
        return new CreatorShowResource(
            $creator
        );
    }
}
