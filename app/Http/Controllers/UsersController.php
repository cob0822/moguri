<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Review;
use Storage;

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
            $name = $request->name;
            $email = $request->email;
            
            if(empty($email) and empty($name)){
                $this->validate($request, [
                   "name" => "required_without:email",
                   "email" => "required_without:name",
                ]);
            }elseif(empty($email)){
                $this->validate($request, [
                   "name" => "required|string|min:4|max:12",
                ]);
            }elseif(empty($name)){
                $this->validate($request, [
                   "email" => "required|string|email|max:255|unique:users",
                ]);
            }else{
                $this->validate($request, [
                    "name" => "required|string|min:4|max:12",
                    "email" => "required|string|email|max:255|unique:users",
                ]);
            }
            
        if(isset($name) and isset($email)){
            \DB::table("users")->where("id", $id)->update([
                "name" => $request->name,
                "email" => $request->email,
            ]);
        }elseif(isset($name)){
            \DB::table("users")->where("id", $id)->update([
                "name" => $request->name,
            ]);
        }elseif(isset($email)){
            \DB::table("users")->where("id", $id)->update([
                "email" => $request->email,
            ]);
        }
        
        $user = User::find($id);
        
        $file = $request->file("icon");
        $path = Storage::disk("s3")->putFile("/", $file, "public");
        
        $url = Storage::disk('s3')->url($path);
        return redirect()->back()->with('s3url', $url);
        
        //$filename = $request->file("icon")->getClientOriginalName();
        //$path = $request->file('icon')->storeAs('public', $filename);
        //return back()->with('filename' => $filename);
        
        
        
        
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
        
        $rateAvg = [];
        
        //ポイントごとのレートの平均値を　"ポイントID" => "レート平均値"　の連想配列で取得
        foreach($favorites as $favorite){
            $rate = \DB::table("reviews")->where("point_id", $favorite->id)->avg("review");
            $rateAvg += array($favorite->id => $rate);
        }
        
        //$data += $this->counts($user);
        
        return view("mypages.favorites", [
            "favorites" => $favorites,    
            "rateAvg" => $rateAvg,
        ]);
    }
}
