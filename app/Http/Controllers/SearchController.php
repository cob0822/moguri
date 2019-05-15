<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Point;

class SearchController extends Controller
{
    public function search(){
        //categoryMonthsに存在する全てのカテゴリを取得してcategoriesに代入
        $categories = \DB::table("categoryMonths")->distinct()->select('category')->get();
        
        return view("search.search", [
            "categories" => $categories,    
        ]);
    }
    
    public function searching(Request $request){
        $category = $request->category;
        $area = $request->area;
        //search.blade.phpのoption valueはint型で渡せないので、int型に変換
        $month = (int)$request->month;
        $points;
        
        //検索ロジック
        //ここもレビュー平均の降順で出すので、あとで追記する
        
        if($request->month != "-" and $request->area != "-"){
            //カテゴリと月とエリアが指定されている場合の検索
            $points = \DB::select("select * from `points` inner join `categoryMonths` on `points`.`id` = `categoryMonths`.`point_id` where `category` = '".$category."' and `months` & ".$month." <> 0 and (`prefecture` = '".$area."' or `area` = '".$area."') ");
        }elseif($request->month != "-"){
            //カテゴリと月が指定されている場合の検索
            $points = \DB::select("select * from `points` inner join `categoryMonths` on `points`.`id` = `categoryMonths`.`point_id` where `category` = '".$category."' and `months` & ".$month." <> 0");
        }elseif($request->area != "-"){
            //カテゴリとエリアが指定されている場合の検索
            //A and (B or C)の処理のため、クロージャを使用している
            $points = \DB::table("points")->join("categoryMonths", "points.id", "=", "categoryMonths.point_id")
                ->where("category",$request->category)
                ->where(function($query) use ($request){
                    $query->where("area", $request->area)
                    ->orWhere("prefecture", $request->area);
                })
                ->get();
        }else{
            //カテゴリのみ指定されている場合の検索
            $points = \DB::table("points")->join("categoryMonths", "points.id", "=", "categoryMonths.point_id")->where("category",$request->category)->get();
        }
        
        //レビューの平均値を返す 今回はsearch_complete Viewにベタ書き
        return view("search.search_complete", [
            "points" => $points,
            "category" => $category,
        ]);
    }
    
    public function detail($id, $category){
        $point = Point::find($id);
        
        //$categories = \DB::table("points")->join("categoryMonths", "points.id", "=", "categoryMonths.point_id")->groupBy("category")->get();
        
        return view("details.detail", [
            "point" => $point,
            "category" => $category,
            //"categories" => $categories,
        ]);
    }
    
    public function ranking_to_detail($id){
        $point = Point::find($id);
        
        //$categories = \DB::table("points")->join("categoryMonths", "points.id", "=", "categoryMonths.point_id")->groupBy("category")->get();
        
        return view("details.detail", [
            "point" => $point,
            "category" => "none",
            //"categories" => $categories,
        ]);
    }
    
    public function favorites_to_detail($id){
        $point = Point::find($id);
        
        //$categories = \DB::table("points")->join("categoryMonths", "points.id", "=", "categoryMonths.point_id")->groupBy("category")->get();
        
        return view("details.detail", [
            "point" => $point,
            "category" => "none",
            //"categories" => $categories,
        ]);
    }
    
    
    
    public function ranking(){
        $points = Point::paginate(10);
        $ranking = array();
        
        foreach($points as $point){
            $rate = $point->reviews()->avg("review");
        }
        
        //1 reviewsテーブルのpointID(distinct), review(AVG)で絞り込む
        
        //2 pointsテーブルと1のreviewsテーブルを結合する
        
        //3 2のpointsテーブルをreview(AVG)の降順で並び替える
        
        
        return view("search.ranking", [
            "points" => $points,    
        ]);
    }
}
