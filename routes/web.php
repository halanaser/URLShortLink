<?php
use App\Http\Controllers\ShortLinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});
 Route::get('/app', function () {
     return view('layouts.shortlink.app');
 });
 Route::get('/shortlink', function () {
    return view('shortenlink');
 })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard',  [ShortLinkController::class ,'index'])
     ->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::get('generate-shorten-link', [ShortLinkController::class ,'index']);  

Route::post('generate-shorten-link', [ShortLinkController::class , 'store'])->middleware(['auth'])->name('generate.shorten.link.post');  
Route::get('{code}', [ShortLinkController::class ,'shortenLink'])->middleware(['auth'])->name('shorten.link');     
Route::get('detail/{id}', [ShortLinkController::class ,'detail'])->middleware(['auth'])->name('Detail');     
