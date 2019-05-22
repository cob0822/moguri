var map;

function initMap() {
 map = new google.maps.Map(document.getElementById('top_googleMap'), { // #sampleに地図を埋め込む
     center: { // 地図の中心を指定
           lat:  39, // 緯度
          lng:   138 // 経度
       },
      zoom: 5 // 地図のズームを指定
   });
}