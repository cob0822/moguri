<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function favoritesPosts($id){
        $user = User::find($id);
        $posts = $user->favoritesPosts()->paginate(10);
        
        $data = [
            "user" => $user,
            "microposts" => $posts,
        ];
        
        $data += $this->counts($user);
        
        return view("users.favorites", $data);
    }

}
