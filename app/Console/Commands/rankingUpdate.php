<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//Carbon(日付取得ライブラリ)を使用するため
use Carbon\Carbon;
use App\Ranking;

class rankingUpdate extends Command
{

    protected $signature = 'ranking:update';

    protected $description = 'Get the rating order desc in daily night.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //rankingsテーブルのデータを全て削除
        \DB::select(\DB::raw("DELETE from rankings"));
        
        //rankingsテーブルにインサートしたいデータを取得
        //多分herokuはpostgreなので以下の生SQLがエラーになっている
        $rankingOrder = \DB::select(\DB::raw("select points.*, (select avg(review) from reviews where point_id = points.id) as avg from points order by avg desc;"));

        //$rankingOrderを1行ずつ取り出し、インサート
        foreach($rankingOrder as $insertRecord){
            $dt = new Carbon();
            Ranking::insert(["point_id" => $insertRecord->id, "area" => $insertRecord->area, "prefecture" => $insertRecord->prefecture, "belowPrefecture" => $insertRecord->belowPrefecture, "latitude" => $insertRecord->latitude, "longitude" => $insertRecord->longitude, "avg" => $insertRecord->avg, "created_at" => $dt, "updated_at" => $dt]);
        }
    }
}

