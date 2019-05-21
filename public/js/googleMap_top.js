var map;

function initMap() {
 map = new google.maps.Map(document.getElementById('top_googleMap'), { // #sampleに地図を埋め込む
     center: { // 地図の中心を指定
           lat:  35.6761919, // 緯度
          lng:   139.6503106 // 経度
       },
      zoom: 19 // 地図のズームを指定
   });
}