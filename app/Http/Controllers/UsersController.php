<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Review;

class UsersController extends Controller
{
    public function mypost(){
        $posts = Review::where("user_id", \Auth::id())->paginate(10);
        
        return view("mypages.posted", [
            "posts" => $posts,    
        ]);
    }

    public function information($id){
        $user = User::find($id);
        
        return view("mypages.user_update", [
            "user" => $user,    
        ]);
    }
    
    public function changeInformation(Request $request, $id){
            $this->validate($request, [
               "name" => "required|string|min:4|max:12",
               "email" => "required|string|email|max:255|unique:users",
            ]);

        \DB::table("users")->where("id", $id)->update([
            "name" => $request->name,
            "email" => $request->email,
        ]);
        
        $user = User::find($id);
        
        
        
        
        //$file = $request->file("file");
        //$path = Storage::disk("s3")->putFile("/", $file, "public");
        
        return view("mypages.user_update_complete", [
            "user" => $user,
        ]);
    }
    
    //お気に入り登録メソッドの呼び出し
    public function favorite(Request $request){
        \Auth::user()->favorites($request->id);
        return back();
    }
    
    //お気に入り削除メソッドの呼び出し
    public function unfavorite(Request $request){
        \Auth::user()->unfavorites($request->id);
        return back();
    }
    
    //お気に入り表示機能
    public function favoritesPoints($id){
        $user = User::find($id);
        $favorites = $user->favoritesPoint()->paginate(10);
        
        //$data += $this->counts($user);
        
        return view("mypages.favorites", [
            "favorites" => $favorites,    
        ]);
    }
}
