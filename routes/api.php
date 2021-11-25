<?php
use App\Http\Controllers\Api\AuthTokenController;
use App\Http\Middleware\CheckApiKey;
use App\Http\Controllers\Api\ShortLinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group([
    'middleware'=>[CheckApiKey::Class],
],function(){
    
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('Shortlinks', [ShortLinkController::class, 'index'])
->middleware('auth:sanctum');

Route::post('Shortlinks', [ShortLinkController::class, 'store'])
->middleware('auth:sanctum');

Route::get('auth/tokens', [AuthTokenController::class, 'index'])
->middleware('auth:sanctum');

Route::post('auth/tokens', [AuthTokenController::class, 'store'])
->middleware('guest:sanctum');

Route::delete('auth/tokens/{id}', [AuthTokenController::class, 'destroy'])
->middleware('auth:sanctum');

});
