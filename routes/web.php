<?php

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
    return view('auth.login');
})->name("user_login");
Route::get("/signup","AuthController@register")->name("user_register");
Route::post("/login","AuthController@login")->name("login");
Route::post("/register","AuthController@signup")->middleware("register")->name("register");
Route::get("/logout","AuthController@logout");
Route::get("/home","Home@index")->name("home");
Route::get("/delete","Home@remove")->name("delete");
Route::get("/edit","Home@update")->name("update");
Route::post("/edit","Home@edit")->name("edit");


