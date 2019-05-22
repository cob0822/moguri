//詳細画面など、GoogleMapを1つ表示する画面

function initMap() {
    console.log(point);
    map = new google.maps.Map(document.getElementById("detailMap"), {

        center: { // 地図の中心を指定
            lat:  Number(point.latitude), // 緯度
            lng:   Number(point.longitude) // 経度
        },
    zoom: 18 // 地図のズームを指定
    });
}

window.onload = function () {
    initMap();
}

