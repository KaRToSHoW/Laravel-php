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
Route::get("/auth/signup", [AuthController::class, "signup"]);
Route::post("/auth/register", [AuthController::class, "register"]);
Route::get("/auth/login", [AuthController::class, "login"])->name('login');
Route::post('/auth/signin', [AuthController::class, 'authenticate']);
Route::get('/auth/logout', [AuthController::class, 'logout']);

//Article
Route::resource('/article', ArticleController::class)->middleware('auth:sanctum');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('article.show')->middleware('click');

//Comment
Route::controller(CommentController::class)->prefix('/comment')->middleware('auth:sanctum')->group(function () {
    Route::post('', 'store');
    Route::get('/{id}/edit', 'edit');
    Route::post('/{comment}/update', 'update');
    Route::get('/{id}/delete', 'delete');
    Route::get('/show', 'show')->name('comment.show');
    Route::get('/{comment}/accept', 'accept');
    Route::get('/{comment}/reject', 'reject');
});

//Main
Route::get('/', [MainController::class, 'index']);

Route::get('/gallery/{img}/{name}', function ($img, $name) {
    return view('main.gallery', ['img' => $img, 'name' => $name]);
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