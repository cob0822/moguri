//ランキング画面など、GoogleMapを複数表示する画面

var map;
var marker = [];
var infoWindow = [];

function initMap() {
   for (var i = 0; i < points.data.length; i++) {
       map = new google.maps.Map(document.getElementById('googleMap' + points.data[i].id + points.data[i].review_id), {

           center: { // 地図の中心を指定

               lat:  Number(points.data[i].latitude), // 緯度
               lng:   Number(points.data[i].longitude) // 経度
           },
       zoom: 18 // 地図のズームを指定
       });


       markerLatLng = new google.maps.LatLng({lat: parseFloat(points.data[i].lat), lng: parseFloat(points.data[i].lng)}); // 緯度経度のデータ作成

               marker[i] = new google.maps.Marker({ // マーカーの追加
                position: markerLatLng, // マーカーを立てる位置を指定
                   map: map // マーカーを立てる地図を指定
              });

            infoWindow[i] = new google.maps.InfoWindow({ // 吹き出しの追加
                content: '<div class="sample">' + points.data[i].name + '</div>' // 吹き出しに表示する内容
              });

            markerEvent(i); // マーカーにクリックイベントを追加
   }
}

// マーカーにクリックイベントを追加
       function markerEvent(i) {
           marker[i].addListener('click', function() { // マーカーをクリックしたとき
             infoWindow[i].open(map, marker[i]); // 吹き出しの表示
         });
       }