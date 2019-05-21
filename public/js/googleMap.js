function initMap() {
    for (var i = 0; i < points.data.length; i++) {
        //console.log('googleMap' + points[i].id);
        map = new google.maps.Map(document.getElementById('googleMap' + points.data[i].id), { // #sampleに地図を埋め込む
        
            center: { // 地図の中心を指定
                lat:  35.6761919, // 緯度
                lng:   139.6503106 // 経度
            },
        zoom: 18 // 地図のズームを指定
        });
    }
}

//var points = {!! json_encode($points->toArray()) !!}
