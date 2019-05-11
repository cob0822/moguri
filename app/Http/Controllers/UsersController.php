<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function mypost(){
        $posts = \DB::table("reviews")->where("user_id", \Auth::id())->get();
        
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
