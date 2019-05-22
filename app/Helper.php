<?php
namespace App;

class Helper
{
    /**
      * public staticとして定義する
      *
      */
    //ジオコーディングAPIの呼び出し(緯度経度の取得)
    public static function getLatLng($googlemap_api,$strAddress = null)
    {
        $latitude = null;
        $longitude = null;
        $status = null; 
        
        if($strAddress == null) {
            $strAddress = $value;
        }
        if (!is_null($strAddress) && '' != $strAddress) {
            $google_leapis_url = "https://maps.googleapis.com/maps/api/geocode/json";

            $pattern    = "/[+]/";
            $strAddress = preg_replace($pattern, "%20", $strAddress);
            // エンコードして半角空白をgeometry用に変換する
            $url_encode = /*urlencode(*/$strAddress/*)*/;

            //dd($google_leapis_url."?address=".$url_encode."&key=".$googlemap_api);
            $jsonData = json_decode(file_get_contents($google_leapis_url."?address=".$url_encode."&language=ja"."&key=".$googlemap_api, false, stream_context_create(array(
                'http' => array(
                    'timeout'=>10 // タイムアウト
                )
            ))), true);
            
            $status = $jsonData["status"];
            
            if(isset($jsonData["results"][0]["geometry"]["location"])) {
                $latitude = $jsonData["results"][0]["geometry"]["location"]["lat"];
                $longitude = $jsonData["results"][0]["geometry"]["location"]["lng"];
            } else {
                $latitude = 0.0;
                $longitude = 0.0;
            }
            //地名入力時の住所補完機能　if文は不要かも
            if(isset($jsonData["results"][0]["address_components"])) {
                
                //prefectureの取得
                $prefectureCheck = null;
                $prefecture = null;
                foreach($jsonData["results"][0]["address_components"] as $key => $element) {
                   if(in_array('administrative_area_level_1', $element['types'])) {
                      $prefectureCheck = $key;
                      $prefecture = $jsonData["results"][0]["address_components"][$prefectureCheck]['long_name'];
                      //dd($prefecture);
                      break;
                   }
                }

                //belowPrefectureの取得
                $belowPrefecture = '';
                $belowPrefectureCheck = null;
                foreach($jsonData["results"][0]["address_components"] as $key => $element) {
                   if(in_array('locality', $element['types'])) {
                      $belowPrefectureCheck = $key;
                      $belowPrefecture .= $jsonData["results"][0]["address_components"][$belowPrefectureCheck]['long_name'];
                      //dd($belowPrefecture);
                   }
                }
                foreach($jsonData["results"][0]["address_components"] as $key => $element) {
                   if(in_array('sublocality_level_1', $element['types'])) {
                      $belowPrefectureCheck = $key;
                      $belowPrefecture .= $jsonData["results"][0]["address_components"][$belowPrefectureCheck]['long_name'];
                      //dd($belowPrefecture);
                   }
                }
                foreach($jsonData["results"][0]["address_components"] as $key => $element) {
                   if(in_array('sublocality_level_2', $element['types'])) {
                      $belowPrefectureCheck = $key;
                      $belowPrefecture .= $jsonData["results"][0]["address_components"][$belowPrefectureCheck]['long_name'];
                      //dd($belowPrefecture);
                   }
                }
                foreach($jsonData["results"][0]["address_components"] as $key => $element) {
                   if(in_array('sublocality_level_3', $element['types'])) {
                      $belowPrefectureCheck = $key;
                      $belowPrefecture .= $jsonData["results"][0]["address_components"][$belowPrefectureCheck]['long_name'];
                      //dd($belowPrefecture);;
                   }
                }
                foreach($jsonData["results"][0]["address_components"] as $key => $element) {
                   if(in_array('sublocality_level_4', $element['types'])) {
                      $belowPrefectureCheck = $key;
                      $belowPrefecture .= $jsonData["results"][0]["address_components"][$belowPrefectureCheck]['long_name'];
                      //dd($belowPrefecture);
                   }
                }
                foreach($jsonData["results"][0]["address_components"] as $key => $element) {
                   if(in_array('premise', $element['types'])) {
                      $belowPrefectureCheck = $key;
                      $belowPrefecture .= "-".$jsonData["results"][0]["address_components"][$belowPrefectureCheck]['long_name'];
                      //dd($belowPrefecture);
                   }
                }
            }
        }
        
        return $status;
    }
}