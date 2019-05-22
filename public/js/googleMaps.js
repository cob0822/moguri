//ランキング画面など、GoogleMapを複数表示する画面

function initMap() {
    for (var i = 0; i < points.data.length; i++) {
        map = new google.maps.Map(document.getElementById('googleMap' + points.data[i].id), { // #sampleに地図を埋め込む

            center: { // 地図の中心を指定
            
                lat:  Number(points.data[i].latitude), // 緯度
                lng:   Number(points.data[i].longitude) // 経度
            },
        zoom: 18 // 地図のズームを指定
        });
    }
}

