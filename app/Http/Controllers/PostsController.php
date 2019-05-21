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
    
    public function postThere($prefecture, $belowPrefecture){
        //categoryMonthsに存在する全てのカテゴリを取得してcategoriesに代入
        $categories = \DB::table("categoryMonths")->distinct()->select('category')->get();
        
        return view("posts.post", [
            "categories" => $categories,   
            "prefecture" => $prefecture,
            "belowPrefecture" => $belowPrefecture,
        ]);
    }
    
    //ジオコーディングAPIの呼び出し(緯度経度の取得)
    public function getLatLng($googlemap_api,$strAddress = null)
    {
        if($strAddress == null) {
            $strAddress = $this->adrs;
        }
        if (!is_null($strAddress) && '' != $strAddress) {
            $google_leapis_url = "https://maps.googleapis.com/maps/api/geocode/json";

            $pattern    = "/[+]/";
            $strAddress = preg_replace($pattern, "%20", $strAddress);
            // エンコードして半角空白をgeometry用に変換する
            $url_encode = /*urlencode(*/$strAddress/*)*/;

            //dd($google_leapis_url."?address=".$url_encode."&key=".$googlemap_api);
            $jsonData = json_decode(file_get_contents($google_leapis_url."?address=".$url_encode."&key=".$googlemap_api, false, stream_context_create(array(
                'http' => array(
                    'timeout'=>10 // タイムアウト
                )
            ))), true);
            
            //dd($jsonData["results"][0]["geometry"]);
            if(isset($jsonData["results"][0]["geometry"]["location"])) {
                $this->latitude = $jsonData["results"][0]["geometry"]["location"]["lat"];
                $this->longitude = $jsonData["results"][0]["geometry"]["location"]["lng"];
            } else {
                $this->latitude = 0.0;
                $this->longitude = 0.0;
            }
        }
    }
    
    public function post_confirm(Request $request){
        $prefectures = implode(',',[
          "青森県", "秋田県", "岩手県", "山形県", "宮城県", "福島県", "新潟県", "富山県", "石川県", "福井県", "長野県", "岐阜県", "山梨県", "静岡県", "愛知県", "群馬県",
           "栃木県", "埼玉県", "茨城県", "東京都", "千葉県", "神奈川県", "兵庫県", "京都府", "滋賀県", "大阪府", "奈良県", "和歌山県", "三重県", "山口県", "島根県", "鳥取県", "広島県",
            "岡山県", "愛媛県", "香川県", "高知県", "徳島県", "長崎県", "佐賀県", "福岡県", "熊本県", "大分県", "鹿児島県", "宮崎県", "北海道", "沖縄県"
        ]);
        
        if($request->pref31)
        $this->validate($request, [
           "pref31" => "required|in:{$prefectures}",
           "addr31" => "required",
           "month" => "required",
           "category1" => "required",
           "review" => "required",
           "comment" => "required|max:300",
        ]);
        
        /*
        if(mb_substr("$request->pref31", -1) != "都" and mb_substr("$request->pref31", -1) != "道" and mb_substr("$request->pref31", -1) != "府" and mb_substr("$request->pref31", -1) != "県"){
            
        }
        */
        
        $prefecture = $request->pref31;
        $belowPrefecture = $request->addr31;
        $month = (int)$request->month;
        $categories = [$request->category1, $request->category2, $request->category3];
        //categoriesからデータ取得できれば、以下１〜３は削除する
        $category1 = $request->category1;
        $category2 = $request->category2;
        $category3 = $request->category3;
        $review = $request->review;
        $comment = $request->comment;
        $area = $this->getArea($prefecture);
        
        //prefectureが北海道か沖縄の場合は、Controller.phpの地域表に存在していないので、地域を代入する
        if($prefecture == "北海道"){
            $area = "北海道";
        }elseif($prefecture == "沖縄県"){
            $area = "沖縄県";
        }
        
        //ジオコーディングメソッドの実行
        $lmg = $this->getLatLng("AIzaSyATubpo-Sq-u-uWRaIZn7gv84_lwCNzRK8", $prefecture.$belowPrefecture);
        
        //ジオコーディングメソッドで取得した緯度経度を変数に格納する
        $latitude = $this->latitude;
        $longitude = $this->longitude;

        $data = [
            "prefecture" => $prefecture,
            "belowPrefecture" => $belowPrefecture,
            "month" => $month,
            "categories" => $categories,
            "category1" => $category1,
            "category2" => $category2,
            "category3" => $category3,
            "review" => $review,
            "comment" => $comment, 
            "latitude" => $latitude,
            "longitude" => $longitude,
            "area" => $area,
        ];
        
        //$dataをセッションに保存
        $request->session()->put($data);
        
        return view("posts.post_confirm", $data);
    }
    
    public function post_complete(Request $request){
        
        //post_confirmメソッドでセッションに保存した$dataを取り出す
        $data = session()->all();
        $point;
        
        //pointsテーブルの更新　緯度経度が存在していなければ、レコードを新規に作成する
        if(\DB::table("points")->where("latitude", $data["latitude"])->where("longitude", $data["longitude"])->exists()){
            $point = \DB::table("points")->where("latitude", $data["latitude"])->where("longitude", $data["longitude"])->get();
        }else{
            \DB::table('points')->insert([
                'area' => $data["area"],
                'prefecture' => $data["prefecture"],
                'belowPrefecture' => $data["belowPrefecture"],
                'latitude' => $data["latitude"],
                'longitude' => $data["longitude"],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            $point = \DB::table("points")->where("latitude", $data["latitude"])->where("longitude", $data["longitude"])->get();
        }
        
        //ポイントidを取得(配列型なので、最初の要素[0]のみ取得)
        $point_id = $point->pluck("id")[0];
        
        $user_id;
        
        if(\Auth::check()){
            $user_id = \Auth::id();
        }else{
            //未ログインの場合は、ゲストユーザー(id=2147483647)として登録
            $user_id = 2147483647;
        }
        
        //reviewsテーブルの更新
        \DB::table('reviews')->insert([
            'user_id' => $user_id,
            'point_id' => $point_id,
            'category1' => $data["category1"],
            'category2' => $data["category2"],
            'category3' => $data["category3"],
            'month' => $data["month"],
            'review' => $data["review"],
            'comment' => $data["comment"],
            'image1' => "test",
            'image2' => "test",
            'image3' => "test",
            "reviewDate" => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        
        //categoryMonthsテーブルの更新
        //category1
        if(\DB::table("categoryMonths")->where("point_id", $point_id)->where("category", $data["category1"])->exists()){
            //月判定のロジック
            
            //categoryMonthsテーブルの該当レコード → monthカラム取り出し
            $checkRecord = \DB::table("categoryMonths")->where("point_id", $point_id)->where("category", $data["category1"])->get();
            
            $checkRecordMonth = $checkRecord->pluck("months")[0];
            
            //controllerの共通メソッド　第一引数：投稿された月　第二引数：categoryMonthsテーブルに既に登録されている月の一覧
            //$existFlagに、第二引数に第一引数が含まれているかの確認結果を格納
            $existFlag = $this->getMonths($data["month"], $checkRecordMonth);
            
            //monthsカラムに投稿した月が含まれていない場合は、投稿した月をmonthsカラムに加算する
            if($existFlag == false){
                \DB::table('categoryMonths')
                    ->where("point_id", $point_id)
                    ->where("category", $data["category1"])
                    ->increment('months', $data["month"]);
            }
        }else{
            \DB::table('categoryMonths')->insert([
                'point_id' => $point_id,
                'category' => $data["category1"],
                'months' => $data["month"],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
        
        //category2
        if(isset($data["category2"])){
            if(\DB::table("categoryMonths")->where("point_id", $point_id)->where("category", $data["category2"])->exists()){
                //月判定のロジック
                
                //categoryMonthsテーブルの該当レコード → monthカラム取り出し
                $checkRecord = \DB::table("categoryMonths")->where("point_id", $point_id)->where("category", $data["category2"])->get();
                $checkRecordMonth = $checkRecord->pluck("months")[0];
                
                //controllerの共通メソッド　第一引数：投稿された月　第二引数：categoryMonthsテーブルに既に登録されている月の一覧
                //$existFlagに、第二引数に第一引数が含まれているかの確認結果を格納
                $existFlag = $this->getMonths($data["month"], $checkRecordMonth);
                
                //monthsカラムに投稿した月が含まれていない場合は、投稿した月をmonthsカラムに加算する
                if($existFlag == false){
                    \DB::table('categoryMonths')
                        ->where("point_id", $point_id)
                        ->where("category", $data["category2"])
                        ->increment('months', $data["month"]);
                }
            }else{
                \DB::table('categoryMonths')->insert([
                    'point_id' => $point_id,
                    'category' => $data["category2"],
                    'months' => $data["month"],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }
        }
            
        //category3
        if(isset($data["category3"])){
            if(\DB::table("categoryMonths")->where("point_id", $point_id)->where("category", $data["category3"])->exists()){
                //月判定のロジック
                
                //categoryMonthsテーブルの該当レコード → monthカラム取り出し
                $checkRecord = \DB::table("categoryMonths")->where("point_id", $point_id)->where("category", $data["category3"])->get();
                $checkRecordMonth = $checkRecord->pluck("months")[0];
                
                //controllerの共通メソッド　第一引数：投稿された月　第二引数：categoryMonthsテーブルに既に登録されている月の一覧
                //$existFlagに、第二引数に第一引数が含まれているかの確認結果を格納
                $existFlag = $this->getMonths($data["month"], $checkRecordMonth);
                
                //monthsカラムに投稿した月が含まれていない場合は、投稿した月をmonthsカラムに加算する
                if($existFlag == false){
                    \DB::table('categoryMonths')
                        ->where("point_id", $point_id)
                        ->where("category", $data["category3"])
                        ->increment('months', $data["month"]);
                }
            }else{
                \DB::table('categoryMonths')->insert([
                    'point_id' => $point_id,
                    'category' => $data["category3"],
                    'months' => $data["month"],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }
        }
        return view("posts.post_complete", compact("data"));
    }
    
    public function post_modify(Request $request, $id){
        $this->validate($request, [
           "review" => "required_without:comment",
           "comment" => "required_without:review",
        ]);
        
        $review = $request->review;
        $comment = $request->comment;    
        
        if(isset($review) and isset($comment)){
            \DB::table("reviews")->where("id", $id)->update(["review" => $review, "comment" => $comment]);    
        }elseif(isset($review)){
            \DB::table("reviews")->where("id", $id)->update(["review" => $review]);
        }elseif(isset($comment)){
            \DB::table("reviews")->where("id", $id)->update(["comment" => $comment]);
        }
        
        return back();
    }
}
