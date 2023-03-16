<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

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



Route::middleware(['jwt.verify'])->get('/user', function (Request $request) {
    return auth()->user();
});


Route::post('/register', [RegisteredUserController::class, 'store'])
                ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->name('login');



Route::group(['middleware' => ['jwt.verify']], function() {


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
->name('logout');


Route::put('/profile', 
[\App\Http\Controllers\Auth\ProfileController::class, 'handler'])
->name('profile');


Route::post('/favorite/character', 
[\App\Http\Controllers\Character\FavotiteCharacterController::class, 'handler']);



Route::get('/favorite/character/{id}', 
[\App\Http\Controllers\Character\GetFavoriteCharactersController::class, 'show']);


Route::get('/favorite/characters', 
[\App\Http\Controllers\Character\GetFavoriteCharactersController::class, 'handler']);


Route::delete('/favorite/character/{id}', 
[\App\Http\Controllers\Character\DeleteFavoriteCharacterController::class, 'handler']);



                });

