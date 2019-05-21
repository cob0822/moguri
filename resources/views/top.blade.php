@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="tipsbar">
            <span>
                {!! link_to_route("search", "目的から探す", [], ["class" => "btn btn-warning btn-sm"]) !!}
            </span>
            <span class="text-white small pl-2 pc_area">
                <見たい生き物やポイントから検索
            </span>
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <!--グーグルマップ
            
            <div class="gmap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13753032.90016899!2d129.42427996777207!3d32.694712168537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f6!3m3!1m2!1s0x34674e0fd77f192f%3A0xf54275d47c665244!2z5pel5pys!5e0!3m2!1sja!2sjp!4v1556797602173!5m2!1sja!2sjp" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>-->
            
            <!--グーグルマップに複数ピンを立てる-->
            <div id="top_googleMap"></div>
            
        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
    <!-- グーグルマップに複数ピンを立てる-->
    <script src="./js/googleMap_top.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATubpo-Sq-u-uWRaIZn7gv84_lwCNzRK8&callback=initMap"></script>
    <script>
        var map;
        var marker = [];
        var infoWindow = [];
        //SearchControllerから緯度経度情報のみをmarkerDataとして取得しているので、point情報は不要
        //var points = {!! json_encode($points->toArray()) !!}
        //緯度経度情報を取得 
        var markerData = {!! json_encode($markerData->toArray()) !!}
        console.log(markerData);
        
        function initMap() {
         // 地図の作成
            var mapLatLng = new google.maps.LatLng({lat: markerData[0]['lat'], lng: markerData[0]['lng']}); // 緯度経度のデータ作成
           map = new google.maps.Map(document.getElementById('sample'), { // #sampleに地図を埋め込む
             center: mapLatLng, // 地図の中心を指定
              zoom: 15 // 地図のズームを指定
           });
         
         // マーカー毎の処理
         for (var i = 0; i < markerData.length; i++) {
                markerLatLng = new google.maps.LatLng({lat: markerData[i]['lat'], lng: markerData[i]['lng']}); // 緯度経度のデータ作成
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
         
        // マーカーにクリックイベントを追加
        function markerEvent(i) {
            marker[i].addListener('click', function() { // マーカーをクリックしたとき
              infoWindow[i].open(map, marker[i]); // 吹き出しの表示
          });
        }
    </script>
@endsection


