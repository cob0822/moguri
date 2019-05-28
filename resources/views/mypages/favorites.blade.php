@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            お気に入りのポイントを登録できます
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3 class="pc_area">MYページ - お気に入りポイント</h3>
            <h5 class="phone_area">MYページ - お気に入りポイント</h5>
            
            @if(isset($favorites[0]))
                @foreach($favorites as $favorite)
                <hr>
                    <div class="row">
                        <div class="col-5 col-md-3">
                            
                            <div class="googleMap" id="googleMap{{$favorite->id}}"></div>
                            
                        </div>
                        <div class="col-7 col-md-9">
                            {{$favorite->prefecture}}
                            {{$favorite->belowPrefecture}}
                            
                            <!--本来はDBからデータ取得はコントローラに記述すべき -->
                            <div class="row">
                                <div class="col-12 col-md-3">
                                @include("commons.star", ["rate" => $rateAvg[$favorite->id]])
                                </div>
                                <div class="col">
                                <span class="ml-2">{{\DB::table("reviews")->where("point_id", $favorite->id)->count("review")}}件の投稿</span>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <p align="right" class="pr-4">{!! link_to_route("favorites_to_detail", "詳細を見る", ["id" => $favorite->id]) !!}</p>
                        </div>    
                    </div>
                @endforeach
                <hr>
            @else
                <hr>
                <div>該当するポイントが見つかりませんでした。</div>
            @endif
        {{$favorites->render('pagination::bootstrap-4')}}
        </div>
        <aside class="pc_area">
            @include("commons.sidemenu")
        </aside>
    </div>
    <script>
        var points = {!! json_encode($favorites->toArray()) !!}
    </script>
    <script src="/js/googleMaps.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATubpo-Sq-u-uWRaIZn7gv84_lwCNzRK8&callback=initMap"></script>
@endsection
