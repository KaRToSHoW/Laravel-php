<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Authenticatte
Route::get("/auth/signup", [AuthController::class,"signup"]);
Route::post("/auth/register", [AuthController::class,"register"]);

//Article
Route::resource('/article', ArticleController::class);

//Comment

Route::post("/comment", [CommentController::class, 'store' ]);
Route::get('/comment/{id}/edit', [CommentController::class,'edit']);
Route::post('/comment/{comment}/update', [CommentController::class,'update']);
Route::get('/comment/{id}/delete', [CommentController::class,'delete']);


//Main
Route::get('/', [MainController::class, 'index']);

Route::get('/gallery/{img}/{name}', function ($img, $name) {
    return view('main.gallery', ['img' => $img, 'name'=> $name]);
});

Route::get('/about', function () {
    return view('main/about');
});

Route::get('/contact', function () {
    $data = [
        'city' => 'Moscow',
        'street' => 'Butlerova',
        'house' => '11',
    ];
    return view('main/contact', ['data' => $data]);
});