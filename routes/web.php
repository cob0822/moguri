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
Route::get("logout", "Auth\LoginController@logout")->name("logout.get");

Route::get("search", "SearchController@search")->name("search");

//Getにしてパラメートを渡す書き方にすべき。質問の参考リンクを元に、後で直す
Route::post("searching", "SearchController@searching")->name("searching");

Route::get("ranking", "SearchController@ranking")->name("ranking");

Route::get("post", "PostsController@post")->name("post");

//本来はpostなので、修正する（テスト用にgetにしている）
Route::get("posting", "PostsController@posting")->name("posting");

Route::get("inquiry", "InquiriesController@inquiry")->name("inquiry");

//本来はpostなので、修正する（テスト用にgetにしている）
Route::get("querying", "InquiriesController@querying")->name("querying");

Route::get("mypost", "UsersController@mypost")->name("mypost");

    Route::group(["prefix" => "{id}"], function(){
        Route::post("favorite", "UsersController@favorite")->name("favorite");
        Route::delete("unfavorite", "UsersController@unfavorite")->name("unfavorite");
    });


//検索結果画面から詳細画面に遷移する場合
//getでリクエストを渡す場合は、URLにパラメータを指定する
Route::group(["prefix" => "search/{id}/{category}"], function(){
    Route::get("detail", "SearchController@detail")->name("detail");
});

//ランキング画面から詳細画面に遷移する場合
Route::group(["prefix" => "ranking/{id}"], function(){
    Route::get("detail", "SearchController@ranking_to_detail")->name("ranking_to_detail");
});

Route::group(["middleware" => ["auth"]], function(){
    Route::group(["prefix" => "users/{id}"], function(){
        Route::get("information", "UsersController@information")->name("information");
        Route::post("changeInformation", "UsersController@changeInformation")->name("changeInformation");
        Route::get("favorites", "UsersController@favoritesPoints")->name("favorites");
    });
    
    //お気に入り画面から詳細画面に遷移する場合
    Route::group(["prefix" => "favorites/{id}"], function(){
        Route::get("detail", "SearchController@favorites_to_detail")->name("favorites_to_detail");
    });
});