@extends("layouts.app")

@section("content")

    @section("test")
        <div class="text-white small">
            
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3>人気のポイントランキング</h3>

            @foreach($points as $point)
            <hr>
                <div class="row">
                    <div class="col-3">
                        
                        
                        
                        <div class="googleMap" id="googleMap{{$point->id}}"></div>
                        
                        
                    </div>
                    <div class="col">
                        {{$point->prefecture}}
                        {{$point->belowPrefecture}}
                        <br>
                        <br>
                        <!--本来はDBからデータ取得はコントローラに記述すべき -->
                        <div class="row">
                            <div class="col-5 col-md-3">
                            @include("commons.star", ["rate" => $point->avg])
                            </div>
                            <div class="col">
                            <span class="ml-2">{{\DB::table("reviews")->where("point_id", $point->point_id)->count("review")}}件の投稿</span>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        
                        
                        <!--カテゴリは指定なしでリクエストする必要があるので、修正する -->
                        
                        <p align="right">{!! link_to_route("ranking_to_detail", "詳細を見る", ["id" => $point->point_id]) !!}</p>
                        
                        
                        
                        
                    </div>    
                </div>
            @endforeach
            <hr>
            {{$points->render('pagination::bootstrap-4')}}
        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
    <script>
        var points = {!! json_encode($points->toArray()) !!}
    </script>
    <script src="./js/googleMap.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATubpo-Sq-u-uWRaIZn7gv84_lwCNzRK8&callback=initMap"></script>
@endsection
