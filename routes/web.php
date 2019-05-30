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

Route::get("/", "SearchController@top")->name("top");

//ユーザー登録
Route::get("signup", "Auth\RegisterController@showRegistrationForm")->name("signup.get");

Route::post("signup", "Auth\RegisterController@register")->name("signup.post");

//ログイン認証
Route::get("login", "Auth\LoginController@showLoginForm")->name("login");
Route::post("login", "Auth\LoginController@login")->name("login.post");
Route::get("logout", "Auth\LoginController@logout")->name("logout.get");

Route::get("search", "SearchController@search")->name("search");
Route::get("search/{init}", "SearchController@searchThis")->name("search.this");

//Getにしてパラメートを渡す書き方にすべき。質問の参考リンクを元に、後で直す
Route::post("searching", "SearchController@searching")->name("searching");

Route::get("ranking", "SearchController@ranking")->name("ranking");

Route::get("post", "PostsController@post")->name("post");
//post_confirmから戻るボタンで戻った際
//Route::get("post/{prefecture}/{belowPrefecture}/{image1}/{image2}/{image3}/{month}/{category1}/{category2}/{category3}/{review}/{comment}", "PostsController@back_post")->name("back.post");
//
Route::get("post/{prefecture}/{belowPrefecture}", "PostsController@postThere")->name("post.there");

Route::group(["prefix" => "post"], function(){
    Route::post("confirm", "PostsController@post_confirm")->name("post.confirm");
    Route::post("complete", "PostsController@post_complete")->name("post.complete");
});

//お問い合わせ
Route::get("inquiry", "InquiriesController@inquiry")->name("inquiry");
Route::post("querying", "InquiriesController@querying")->name("querying");

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

//ログイン後のprefixに入れるべきだが、入れると何故かエラーになる
Route::get("mypost", "UsersController@mypost")->name("mypost");
Route::post("mypost/modify/{id}", "PostsController@post_modify")->name("post.modify");
Route::get("detail/{id}", "SearchController@posted_to_detail")->name("posted_to_detail");

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

//ファイルアップロード
//Route::get('upload', 'UploadController@create');
//Route::post('upload', 'UploadController@store');