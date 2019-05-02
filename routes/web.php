<?php

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
    return view('top');
});

//ユーザー登録
Route::get("signup", "Auth\RegisterController@showRegistrationForm")->name("signup.get");

Route::post("signup", "Auth\RegisterController@register")->name("signup.post");

//ログイン認証
Route::get("login", "Auth\LoginController@showLoginForm")->name("login");
Route::post("login", "Auth\LoginController@login")->name("login.post");
//Route::get("logout", "Auth\LoginController@logout")->name("logout.get");

Route::get("search", "SearchController@search")->name("search");

//本来はpostなので、修正する（テスト用にgetにしている）
Route::get("searching", "SearchController@searching")->name("searching");

Route::get("detail", "SearchController@detail")->name("detail");
Route::get("ranking", "SearchController@ranking")->name("ranking");

Route::get("post", "PostsController@post")->name("post");

//本来はpostなので、修正する（テスト用にgetにしている）
Route::get("posting", "PostsController@posting")->name("posting");

Route::get("inquiry", "InquiriesController@inquiry")->name("inquiry");

//本来はpostなので、修正する（テスト用にgetにしている）
Route::get("querying", "InquiriesController@querying")->name("querying");

Route::get("mypost", "UsersController@mypost")->name("mypost");
Route::get("favorites", "UsersController@favorites")->name("favorites");
Route::get("information", "UsersController@information")->name("information");