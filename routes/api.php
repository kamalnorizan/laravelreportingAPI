<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Validator;
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

Route::prefix('v1')->group(__DIR__.'/apiV1.php');
Route::prefix('v2')->group(__DIR__.'/apiV2.php');

