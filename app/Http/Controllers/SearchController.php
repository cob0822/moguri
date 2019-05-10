<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Point;

class SearchController extends Controller
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
    
    public function search(){
        //categoryMonthsに存在する全てのカテゴリを取得してcategoriesに代入
        $categories = \DB::table("categoryMonths")->distinct()->select('category')->get();
        
        return view("search.search", [
            "categories" => $categories,    
        ]);
    }
    
    public function searching(Request $request){
        //test用に全てのポイントを返す
        //$points = Point::all();
        
        $category = $request->category;
        
        
        
        $points;
        
        //検索ロジック
        //ここもレビュー平均の降順で出すので、あとで追記する
        
        if($request->month != "-" and $request->area != "-"){
            //カテゴリと月とエリアが指定されている場合の検索
            
        }elseif($request->month != "-"){
            //カテゴリと月が指定されている場合の検索
            //points = \DB::table("points")->join("categoryMonths", "points.id", "=", "categoryMonths.point_id")
            //    ->where("category",$request->category)->where
                
                
                
                
                
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
        $points = Point::all();
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
