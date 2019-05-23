//検索結果画面は配列のデータの持ち方がランキング画面等と異なるので、別途GoogleMap表示メソッドを用意した

function initMap() {
    for (var i = 0; i < points.length; i++) {
        map = new google.maps.Map(document.getElementById('googleMap' + points[i].id), {

            center: { // 地図の中心を指定
            
                lat:  Number(points[i].latitude), // 緯度
                lng:   Number(points[i].longitude) // 経度
            },
        zoom: 18 // 地図のズームを指定
        });
    }
}

