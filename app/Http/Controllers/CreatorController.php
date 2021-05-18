<?php

namespace App\Http\Controllers;

use App\Http\Resources\CreatorResource;
use App\Models\Creator;
use App\Scoping\Scopes\FollowersScope;
use App\Scoping\Scopes\LanguagesScope;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    public function index(){
        return CreatorResource::collection(
            Creator::withScopes($this->scopes())->paginate(10)
        );
    }

    protected function scopes() {
        return [
            'followers' => new FollowersScope(),
            'languages' => new LanguagesScope
        ];
    }

}
