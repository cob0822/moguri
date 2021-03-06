<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Point;
use App\Review;
use App\Ranking;
//Carbon(日付取得ライブラリ)を使用するため
use Carbon\Carbon;


class SearchController extends Controller
{
    public function search(){
        //categoryMonthsに存在する全てのカテゴリを取得してcategoriesに代入
        $categories = \DB::table("categorymonths")->distinct()->select('category')->get();
        
        return view("search.search", [
            "categories" => $categories,   
        ]);
    }
    
    public function searchThis($init){
        //categoryMonthsに存在する全てのカテゴリを取得してcategoriesに代入
        $categories = \DB::table("categorymonths")->distinct()->select('category')->get();
        
        return view("search.search", [
            "categories" => $categories,   
            "init" => $init,
        ]);
    }
    
    public function searching(Request $request){
        $this->validate($request, [
           "category" => "required",
        ]);
        
        $category = $request->category;
        $area = $request->area;
        //search.blade.phpのoption valueはint型で渡せないので、int型に変換
        $month = (int)$request->month;
        $points;
        
        //検索ロジック
        //ここもレビュー平均の降順で出すので、あとで追記する
        
        if($request->month != "-" and $request->area != "-"){
            //カテゴリと月とエリアが指定されている場合の検索
            $points = \DB::select("select * from points inner join categorymonths on points.id = categorymonths.point_id where category = :category and months & :month <> 0 and (prefecture = :prefecture or area = :area)", ["category" => $category, "month" => $month, "prefecture" => $area, "area" => $area]);
        }elseif($request->month != "-"){
            //カテゴリと月が指定されている場合の検索
            $points = \DB::select("select * from points inner join categorymonths on points.id = categorymonths.point_id where category = :category and months & :month <> 0", ["category" => $category, "month" => $month]);
        }elseif($request->area != "-"){
            //カテゴリとエリアが指定されている場合の検索
            //A and (B or C)の処理のため、クロ���ジャを使用している
            $points = \DB::table("points")->join("categorymonths", "points.id", "=", "categorymonths.point_id")
                ->where("category",$request->category)
                ->where(function($query) use ($request){
                    $query->where("area", $request->area)
                    ->orWhere("prefecture", $request->area);
                })
                ->get();
        }else{
            //カテゴリのみ指定されている場合の検索
            $points = \DB::table("points")->join("categorymonths", "points.id", "=", "categorymonths.point_id")->where("category",$request->category)->get();
        }
        
        //ポイントごとのレートの平均値を　"ポイントID" => "レート平均値"　の連想配列で取得
        $rateAvg = [];
        
        foreach($points as $point){
            $rate = \DB::table("reviews")->where("point_id", $point->point_id)->avg("review");
            $rateAvg += array($point->point_id => $rate);
        }

        return view("search.search_complete", [
            "points" => $points,
            "category" => $category,
            "rateAvg" => $rateAvg,
        ]);
    }
    
    public function detail($id, $category){
        $point = Point::find($id);
        $month = [];
        $reviews = Review::where("point_id", $id)->paginate(10);
        
        foreach($point->reviews as $review){
            $month += array($review->review_id => $this->getMonth($review->month));
        }
        
        //$categories = \DB::table("points")->join("categoryMonths", "points.id", "=", "categoryMonths.point_id")->groupBy("category")->get();
        
        //ポイントのレートの平均値を取得
            $rateAvg = \DB::table("reviews")->where("point_id", $point->id)->avg("review");
            
        return view("details.detail", [
            "point" => $point,
            "category" => $category,
            "rateAvg" => $rateAvg,
            "month" => $month,
            "reviews" => $reviews,
            //"categories" => $categories,
        ]);
    }
    
    public function ranking_to_detail($id){
        $point = Point::find($id);
        $month = [];
        $reviews = Review::where("point_id", $id)->paginate(10);

        foreach($point->reviews as $review){
            $month += array($review->review_id => $this->getMonth($review->month));
        }
        
        //$categories = \DB::table("points")->join("categoryMonths", "points.id", "=", "categoryMonths.point_id")->groupBy("category")->get();
        
        //ポイントのレートの平均値を取得
            $rateAvg = \DB::table("reviews")->where("point_id", $point->id)->avg("review");
            
        return view("details.detail", [
            "point" => $point,
            "category" => "none",
            "rateAvg" => $rateAvg,
            "month" => $month,
            "reviews" => $reviews,
            //"categories" => $categories,
        ]);
    }
    
    public function favorites_to_detail($id){
        $point = Point::find($id);
        $month = [];
        $reviews = Review::where("point_id", $id)->paginate(10);
        
        foreach($point->reviews as $review){
            $month += array($review->review_id => $this->getMonth($review->month));
        }
        
        //$categories = \DB::table("points")->join("categoryMonths", "points.id", "=", "categoryMonths.point_id")->groupBy("category")->get();
        
        //ポイントのレートの平均値を取得
            $rateAvg = \DB::table("reviews")->where("point_id", $point->id)->avg("review");

        return view("details.detail", [
            "point" => $point,
            "category" => "none",
            "rateAvg" => $rateAvg,
            "month" => $month,
            "reviews" => $reviews,
            //"categories" => $categories,
        ]);
    }
    
    public function posted_to_detail($id){
        $point = Point::find($id);
        $month = [];
        $reviews = Review::where("point_id", $id)->paginate(10);
        
        foreach($reviews as $review){
            $month += array($review->review_id => $this->getMonth($review->month));
        }
        
        //$categories = \DB::table("points")->join("categoryMonths", "points.id", "=", "categoryMonths.point_id")->groupBy("category")->get();
        
        //ポイントのレートの平均値を取得
            $rateAvg = \DB::table("reviews")->where("point_id", $point->id)->avg("review");

        return view("details.detail", [
            "point" => $point,
            "category" => "none",
            "rateAvg" => $rateAvg,
            "month" => $month,
            "reviews" => $reviews,
            //"categories" => $categories,
        ]);
    }
    
    public function ranking(){
        
        //本当は以下の処理を/moguri/app/Console/Commands/rankingUpdate.phpでバッチ処理したいが、AWSは未使用時に停止してしまうので、ランキング表示時に毎回処理
        //rankingsテーブルのデータを全て削除
        \DB::select(\DB::raw("DELETE from rankings"));
        
        //rankingsテーブルにインサートしたいデータを取得
        //coalesceを使用して、avgが取得できない場合(何らかの理由でreviewsテーブルにデータが存在しない場合)はデフォルト値でavg=0を入れている
        $rankingOrder = \DB::select(\DB::raw("select points.*, coalesce((select avg(review) from reviews where point_id = points.id), 0) as avg from points order by avg desc;"));
        //$rankingOrderを1行ずつ取り出し、インサート
        foreach($rankingOrder as $insertRecord){
            $dt = new Carbon();
            Ranking::insert(["point_id" => $insertRecord->id, "area" => $insertRecord->area, "prefecture" => $insertRecord->prefecture, "belowPrefecture" => $insertRecord->belowPrefecture, "latitude" => $insertRecord->latitude, "longitude" => $insertRecord->longitude, "avg" => $insertRecord->avg, "created_at" => $dt, "updated_at" => $dt]);
        }
        
        //Rankingモデルから、rankingsテーブルのデータ一覧を取得
        $points = Ranking::paginate(10);
        
        return view("search.ranking", [
            "points" => $points,
        ]);
    }
    
    public function top(){
        $points = Point::all();
        $markerData = $points->map(function($point) {
          return  [
            'name' => $point->prefecture.$point->belowPrefecture,
            'lat' => $point->latitude,
            'lng' => $point->longitude,
          ];
        });
        
        //dd($markerData);
        return view("top", [
           "points" => $points, 
           "markerData" => $markerData,
        ]);
    }
}

