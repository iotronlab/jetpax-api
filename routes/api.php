<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ContactFormController;
use App\Http\Controllers\api\CreatorController;
use App\Http\Controllers\api\PortfolioController;
use App\Http\Controllers\FilterController;

use App\Models\Creator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('businessform', [ContactFormController::class, "uploadBusinessForm"]);
Route::post('creatorform', [ContactFormController::class, "uploadCreatorForm"]);


Route::get('filter', [FilterController::class, "index"]);

Route::apiResource('portfolios', PortfolioController::class)->only(['index', 'show'])->scoped([
    'portfolio' => 'url',
]);

Route::get('posts', [PortfolioController::class, "getPosts"]);
Route::get('posts/{post:uuid}', [PortfolioController::class, "getPost"]);

Route::apiResource('creators', CreatorController::class)->scoped([
    'creator' => 'url',
]);
