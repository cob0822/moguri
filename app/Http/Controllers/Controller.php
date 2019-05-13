<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    //都道府県名から地方名を取得
    public function getArea($prefecture){
        switch($prefecture){
            case "青森県":
                return "東北地方";
                break;
            case "秋田県":
                return "東北地方";
                break;
            case "岩手県":
                return "東北地方";
                break;
            case "山形県":
                return "東北地方";
                break;
            case "宮城県":
                return "東北地方";
                break;
            case "福島県":
                return "東北地方";
                break;
            case "新潟県":
                return "中部地方";
                break;
            case "富山県":
                return "中部地方";
                break;
            case "石川県":
                return "中部地方";
                break;
            case "福井県":
                return "中部地方";
                break;
            case "長野県":
                return "中部地方";
                break;
            case "岐阜県":
                return "中部地方";
                break;
            case "山梨県":
                return "中部地方";
                break;
            case "静岡県":
                return "中部地方";
                break;
            case "愛知県":
                return "中部地方";
                break;
            case "群馬県":
                return "関東地方";
                break;
            case "栃木県":
                return "関東地方";
                break;
            case "埼玉県":
                return "関東地方";
                break;
            case "茨城県":
                return "関東地方";
                break;
            case "東京都":
                return "関東地方";
                break;
            case "千葉県":
                return "関東地方";
                break;
            case "神奈川県":
                return "関東地方";
                break;
            case "兵庫県":
                return "近畿地方";
                break;
            case "京都府":
                return "近畿地方";
                break;
            case "滋賀県":
                return "近畿地方";
                break;
            case "大阪府":
                return "近畿地方";
                break;
            case "奈良県":
                return "近畿地方";
                break;
            case "和歌山県":
                return "近畿地方";
                break;
            case "三重県":
                return "近畿地方";
                break;
            case "山口県":
                return "中国地方";
                break;
            case "島根県":
                return "中国地方";
                break;
            case "鳥取県":
                return "中国地方";
                break;
            case "広島県":
                return "中国地方";
                break;
            case "岡山県":
                return "中国地方";
                break;
            case "愛媛県":
                return "四国地方";
                break;
            case "香川県":
                return "四国地方";
                break;
            case "高知県":
                return "四国地方";
                break;
            case "徳島県":
                return "四国地方";
                break;
            case "長崎県":
                return "九州地方";
                break;
            case "佐賀県":
                return "九州地方";
                break;
            case "福岡県":
                return "九州地方";
                break;
            case "熊本県":
                return "九州地方";
                break;
            case "大分県":
                return "九州地方";
                break;
            case "鹿児島県":
                return "九州地方";
                break;
            case "宮崎県":
                return "九州地方";
                break;
        }
    }
    
    //pointsテーブルのmonthカラムを元に、含まれる月の一覧を取得
    public function getMonths($postedMonth, $existingMonths){
        //bitと月ラベルの対応表
        $months = [
          0b000000000001 => "1月", //1
          0b000000000010 => "2月", //2
          0b000000000100 => "3月", //4
          0b000000001000 => "4月", //8
          0b000000010000 => "5月", //16
          0b000000100000 => "6月", //32
          0b000001000000 => "7月", //64
          0b000010000000 => "8月", //128
          0b000100000000 => "9月", //256
          0b001000000000 => "10月", //512
          0b010000000000 => "11月", //1024
          0b100000000000 => "12月", //2028
        ];

        $postedMonthLabel;
        $existingMonthsLabel = [];
        
        //投稿された月が既に登録されているかの確認フラグ
        $existFlag = false;
        
        //投稿された月に対応する、対応表のラベルを取り出す
        foreach($months as $bit => $monthLabel){
            if($postedMonth & $bit){
                $postedMonthLabel = $monthLabel;
            }
        }
        
        //categoryMonthsテーブルの月カラムに対応する、対応表のラベル一覧を配列で取り出す
        foreach($months as $bit => $monthLabel){
            if($existingMonths & $bit){
                array_push($existingMonthsLabel, $monthLabel);
            }
        }
        
        foreach($existingMonthsLabel as $exist){
            if($exist == $postedMonthLabel){
                $existFlag = true;
            }
        }
        
        return $existFlag;
    }
}
