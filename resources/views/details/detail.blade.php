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
                                
                            @if($point->belowPrefecture != "")
                                {!! link_to_route("post.there", "投稿", ["prefecture" => $point->prefecture, "belowPrefecture" => $point->belowPrefecture], ["class" => "btn btn-warning"]) !!}
                            @elseif($point->belowPrefecture == "")
                                <!--belowPrefectureを持たないポイントの場合は、belowPrefectureに" "をセット(""やnullではエラーになった)-->
                                {!! link_to_route("post.there", "投稿", ["prefecture" => $point->prefecture, "belowPrefecture" => " "], ["class" => "btn btn-warning"]) !!}
                            @endif
                            
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

                @foreach($point->reviews as $review)
                
                    <!-- 画像の表示(クリック時モーダル表示) -->
                    @if(isset($review->image1))
                        <button type="button" class="btn" data-toggle="modal" data-target="#review_id{{$review->review_id}}image1">
                            <img src="{{$review->image1}}" width="65" height="50">
                        </button>
                    @endif
                    @if(isset($review->image2))
                        <button type="button" class="btn" data-toggle="modal" data-target="#review_id{{$review->review_id}}image2">
                            <img src="{{$review->image2}}" width="65" height="50">
                        </button>
                    @endif
                    @if(isset($review->image3))
                        <button type="button" class="btn" data-toggle="modal" data-target="#review_id{{$review->review_id}}image3">
                            <img src="{{$review->image3}}" width="65" height="50">
                        </button>
                    @endif
                    
                    <!-- モーダルの表示 -->
                        <div class="modal" id="review_id{{$review->review_id}}image1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">画像の詳細</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{$review->image1}}" width="312" height="240">
                                    </div>
                                    <div class="modal-footer">
                                        <span>投稿者:{{$review->user->name}}</span>
                                        &emsp;
                                        <span>投稿日:{{$review->created_at}}</span>
                                        &emsp;
                                        &emsp;
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- モーダルここまで -->
                    
                    <!-- モーダルの表示 -->
                        <div class="modal" id="review_id{{$review->review_id}}image2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">画像の詳細</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{$review->image2}}" width="195" height="150">
                                    </div>
                                    <div class="modal-footer">
                                        <span>投稿者:{{$review->user->name}}</span>
                                        &emsp;
                                        <span>投稿日:{{$review->created_at}}</span>
                                        &emsp;
                                        &emsp;
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- モーダルここまで -->
                    
                    <!-- モーダルの表示 -->
                        <div class="modal" id="review_id{{$review->review_id}}image3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">画像の詳細</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{$review->image3}}" width="390" height="300">
                                    </div>
                                    <div class="modal-footer">
                                        <span>投稿者:{{$review->user->name}}</span>
                                        &emsp;
                                        <span>投稿日:{{$review->created_at}}</span>
                                        &emsp;
                                        &emsp;
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- モーダルここまで -->
 
                @endforeach
                
            <hr>
            
            @foreach($reviews as $review) 
                <div class="row">
                    <div class="col-3">
                        @if($review->user_id == 2147483647 or !isset($review->user->icon))
                            <img src="https://s3-ap-northeast-1.amazonaws.com/moguri/Guest/icoon-mono.png" width="65" height="60">
                        @else
                            <img src="{{$review->user->icon}}" width="70" height="55">
                        @endif
                        
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
