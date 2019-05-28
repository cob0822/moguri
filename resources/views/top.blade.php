@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="tipsbar">
            <span>
                {!! link_to_route("search", "目的から探す", [], ["class" => "btn btn-warning btn-sm"]) !!}
            </span>
            <span class="text-white small pl-2 pc_area">
                <見たい生き物やエリアから検索
            </span>
            <span class="text-white small pl-2 phone_area">
                <見たい生き物から検索
            </span>
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3 class="pc_area">MAP</h3>
            <h4 class="phone_area">MAP</h4>
            <hr>
            <p>現在、{!! count($points) !!}件のポイントが登録されています</p>
            <!--グーグルマップに複数ピンを立てる-->
            <div id="top_googleMap" style="width:100%;"></div>
            
        </div>
        <aside class="pc_area">
            @include("commons.sidemenu")
        </aside>
    </div>
    <!-- グーグルマップに複数ピンを立てる-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATubpo-Sq-u-uWRaIZn7gv84_lwCNzRK8&callback=initMap"></script>
    
    <script>
        var map;
        var marker = [];
        var infoWindow = [];
        
        //Searchコントローラから$markerData(緯度経度情報)を取得
        var markerData = {!! $markerData !!}
        //console.log(markerData[0]["name"]);
        
        function initMap() {
         // 地図の作成
            //var mapLatLng = new google.maps.LatLng({lat: parseFloat(markerData[0]['lat']), lng: parseFloat(markerData[0]['lng'])}); // 緯度経度のデータ作成
            var mapLatLng = new google.maps.LatLng({lat: 39, lng: 138}); // 緯度経度のデータ作成
           map = new google.maps.Map(document.getElementById('top_googleMap'), { // #top_googleMapに地図を埋め込む
             center: mapLatLng, // 地図の中心を指定
              zoom: 5 // 地図のズームを指定
           });
         
         // マーカー毎の処理
         for (var i = 0; i < markerData.length; i++) {
             //console.log(markerData[i]);
                markerLatLng = new google.maps.LatLng({lat: parseFloat(markerData[i]['lat']), lng: parseFloat(markerData[i]['lng'])}); // 緯度経度のデータ作成
                
                marker[i] = new google.maps.Marker({ // マーカーの追加
                 position: markerLatLng, // マーカーを立てる位置を指定
                    map: map // マーカーを立てる地図を指定
               });
         
             infoWindow[i] = new google.maps.InfoWindow({ // 吹き出しの追加
                 content: '<div class="sample">' + markerData[i]['name'] + '</div>' // 吹き出しに表示する内容
               });
         
             markerEvent(i); // マーカーにクリックイベントを追加
         }
         /*
           marker[0].setOptions({// TAM 東京のマーカーのオプション設定
                icon: {
                 url: markerData[0]['icon']// マーカーの画像を変更
               }
           });
         */
        }
         
        initMap();
        
        // マーカーにクリックイベントを追加
        function markerEvent(i) {
            marker[i].addListener('click', function() { // マーカーをクリックしたとき
              infoWindow[i].open(map, marker[i]); // 吹き出しの表示
          });
        }
    </script>
@endsection


