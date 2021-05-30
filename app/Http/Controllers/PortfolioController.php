<?php

namespace App\Http\Controllers;

use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    //
    public function index()
    {
        return PortfolioResource::collection(
            Portfolio::paginate(10)
        );
    }
}
