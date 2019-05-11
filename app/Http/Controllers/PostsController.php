<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function post(){
        //categoryMonthsに存在する全てのカテゴリを取得してcategoriesに代入
        $categories = \DB::table("categoryMonths")->distinct()->select('category')->get();
        
        return view("posts.post", [
            "categories" => $categories,    
        ]);
    }
    
    public function posting(){
        
        return view("posts.post_complete");
    }
}
