@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            ポイント毎に詳細が見られます
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3 class="pc_area"><strong>{{$category}}</strong>の検索結果</h3>
            <h5 class="phone_area"><strong>{{$category}}</strong>の検索結果</h5>
            <!-- 該当のポイントが１件もない場合は、その旨のメッセージを表示する ※isset($points[0]) -> $points配列の先頭にデータがセットされている場合 -->
            @if(isset($points[0]))
                @foreach($points as $point)
                <hr>
                    <div class="row">
                        <div class="col-5 col-md-3">
                            
                            <div class="googleMap" id="googleMap{{$point->id}}"></div>
                            
                        </div>
                        <div class="col-7 col-md-9">
                            {{$point->prefecture}}
                            {{$point->belowPrefecture}}
                            <br>
                            <!--本来はDBからデータ取得はコントローラに記述すべき -->
                            <div class="row">
                                <div class="col-12 col-md-3">
                                @include("commons.star", ["rate" => $rateAvg[$point->point_id]])
                                </div>
                                <div class="col">
                                <span class="ml-2">{{\DB::table("reviews")->where("point_id", $point->point_id)->count("review")}}件の投稿</span>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <p align="right" class="pr-4">{!! link_to_route("detail", "詳細を見る", ["id" => $point->point_id, "category" => $category]) !!}</p>
                        </div>    
                    </div>
                @endforeach
                <hr>
            @else
                <hr>
                <div>該当するポイントが見つかりませんでした。</div>
            @endif
        </div>
        <aside class="pc_area">
            @include("commons.sidemenu")
        </aside>
    </div>
    <script>
        var points = {!! json_encode($points) !!}
    </script>
    <script src="/js/googleMapsForSearchComplete.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATubpo-Sq-u-uWRaIZn7gv84_lwCNzRK8&callback=initMap"></script>
@endsection
