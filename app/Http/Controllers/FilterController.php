<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilterResource;
use App\Models\Filter\Filter;
use App\Models\Filter\FilterOption;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    //
    public function index(){


        // $data = Filter::with('options')->get();

        return FilterResource::collection(
            Filter::with('options')->get()
        );

        // return response()->json($data);

    }
}
