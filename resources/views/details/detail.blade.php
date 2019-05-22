@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            「お気に入りに追加」機能はログイン後に利用できます
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            @if($category != "none")
                <h3><strong>{{$category}}</strong>が見られるポイント</h3>
            @else
                <h3>ポイントの詳細</h3>
            @endif
            
            <hr>
                <div class="row">
                    <div class="col-3">
                            
                            
                            
                            <div class="googleMap" id="detailMap"></div>
                            
                            
                            
                    </div>
                    <div class="col">
                        {{$point->prefecture}}
                        {{$point->belowPrefecture}}
                        <br>
                        <div class="row">
                            <div class="col-5 col-md-3">
                                @include("commons.star", ["rate" => $rateAvg])
                            </div>
                            <div class="col">
                            <!--本来はDBからデータ取得はコントローラに記述すべき -->
                            <span class="ml-2">{{\DB::table("reviews")->where("point_id", $point->id)->count("review")}}件の投稿</span>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-4 offset-md-1 col-md-2">
                                
                            {!! link_to_route("post.there", "投稿", ["prefecture" => $point->prefecture, "belowPrefecture" => $point->belowPrefecture], ["class" => "btn btn-warning"]) !!}

                                
                            </div>
                            <div class="col-8 col-md-4">
                                @include("users.favorite_button")
                            </div>
                            <div class="col-12 col-md-5">
                                付近のショップを見る
                            </div>
                        </div>  
                          
                    </div>    
                </div>
            <hr>
                <!--画像一覧を表示する -->
                <div class="jumbotron">ここに画像一覧を表示する</div>
            <hr>
            
            @foreach($reviews as $review) 
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <!--アイコンを表示する -->
                            ここにアイコンを表示する
                        </div>
                    </div>
                    <div class="col">
                        <div>{{$review->user->name}}</div>
                        @include("commons.star", ["rate" => $review->review])
                        
                        <!--カテゴリ２と３がない場合,を表示しないように修正する -->
                        <div align="right">カテゴリ：
                            {{$review->category1}}
                                @if($review->category2)
                                    ,{{$review->category2}}
                                @endif
                                @if($review->category3)
                                    ,{{$review->category3}}
                                @endif
                            &emsp;時期：{{$month[$review->id]}}月
                        </div>
                        <br>
                        <div>{{$review->comment}}</div>
                    </div>
                </div>
                <hr>
            @endforeach
            {{$reviews->render('pagination::bootstrap-4')}}
        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
    <script>
        var point = {!! json_encode($point) !!}
    </script>
    <script src="/js/googleMap.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATubpo-Sq-u-uWRaIZn7gv84_lwCNzRK8&callback=initMap"></script>
@endsection
