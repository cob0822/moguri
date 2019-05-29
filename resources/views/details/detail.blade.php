@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            ログインするとお気に入りに追加できます
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            @if($category != "none")
                <h3 class="pc_area"><strong>{{$category}}</strong>が見られるポイント</h3>
                <h5 class="phone_area"><strong>{{$category}}</strong>が見られるポイント</h5>
            @else
                <h3 class="pc_area">ポイントの詳細</h3>
                <h5 class="phone_area">ポイントの詳細</h5>
            @endif
            
            <hr>
                <div class="row">
                    <div class="col-5 col-md-3">
                            
                            <div class="googleMap" id="detailMap"></div>
                            
                                <div class="col-sm-3 phone_area">
                                    <br>&emsp;
                                    @if($point->belowPrefecture != "")
                                        {!! link_to_route("post.there", "投稿", ["prefecture" => $point->prefecture, "belowPrefecture" => $point->belowPrefecture], ["class" => "btn btn-warning"]) !!}
                                    @elseif($point->belowPrefecture == "")
                                        <!--belowPrefectureを持たないポイントの場合は、belowPrefectureに" "をセット(""やnullではエラーになった)-->
                                        {!! link_to_route("post.there", "投稿", ["prefecture" => $point->prefecture, "belowPrefecture" => " "], ["class" => "btn btn-warning"]) !!}
                                    @endif
                                </div>
                                
                    </div>
                    <div class="col-7 col-md-9">
                        {{$point->prefecture}}
                        {{$point->belowPrefecture}}
                        <br>
                        <div class="row">
                            <div class="col-12 col-md-3">
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
                        
                        <div class="row">
                            <div class="col-5 offset-md-1 col-md-2 pc_area">
                                
                            @if($point->belowPrefecture != "")
                                {!! link_to_route("post.there", "投稿", ["prefecture" => $point->prefecture, "belowPrefecture" => $point->belowPrefecture], ["class" => "btn btn-warning"]) !!}
                            @elseif($point->belowPrefecture == "")
                                <!--belowPrefectureを持たないポイントの場合は、belowPrefectureに" "をセット(""やnullではエラーになった)-->
                                {!! link_to_route("post.there", "投稿", ["prefecture" => $point->prefecture, "belowPrefecture" => " "], ["class" => "btn btn-warning"]) !!}
                            @endif
                            
                            </div>
                            <div class="col-12 col-md-4 pc_area">
                                @include("users.favorite_button")
                            </div>
                            <div class="col-12 phone_area mt-4">
                                @include("users.favorite_button")
                            </div>
                            <div class="col-12 col-md-5 pc_area">
                                <div class="btn btn-primary disabled">
                                    <s>付近のショップを見る</s>
                                </div>
                            </div>
                        </div>  
                          
                    </div>    
                </div>
            <hr>
                <!--画像一覧を表示する -->

                <!-- 以下コメントアウトは画像の横スクロール(public/js/script.jsも) -->
                <!--
                 <div class="container text-center my-3">
                        <div class="row mx-auto my-auto">
                            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                            <div class="carousel-inner w-100" role="listbox">
                -->
                    
                <!-- ここだけHTMLに変数宣言　画像がない場合、下線<hr>を出さないため-->
                <?php $count = 0; ?>
                
                @foreach($point->reviews as $review)
                
                    <!-- 画像の表示(クリック時モーダル表示) -->
                    @if(isset($review->image1))
                    <!-- <div class="carousel-item active"> -->
                        <button type="button" class="btn" data-toggle="modal" data-target="#review_id{{$review->review_id}}image1">
                            <img src="{{$review->image1}}" width="65" height="50">
                        </button>
                        <?php $count += 1; ?>
                    <!-- </div> --> 
                    @endif
                
                
                    @if(isset($review->image2))
                    <!--  <div class="carousel-item"> -->
                        <button type="button" class="btn" data-toggle="modal" data-target="#review_id{{$review->review_id}}image2">
                            <img src="{{$review->image2}}" width="65" height="50">
                        </button>
                        <?php $count += 1; ?>
                    <!--   </div> -->
                    @endif
                
                
                    @if(isset($review->image3))
                    <!--<div class="carousel-item"> -->
                        <button type="button" class="btn" data-toggle="modal" data-target="#review_id{{$review->review_id}}image3">
                            <img src="{{$review->image3}}" width="65" height="50">
                        </button>
                        <?php $count += 1; ?>
                    <!--   </div> -->
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
                            <!--    </div>
                                <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div> -->
            @if($count != 0)
                <hr>
            @endif
            
            @foreach($reviews as $review) 
                <div class="row">
                    <div class="col-3 col-md-2">
                        @if($review->user_id == 3 or !isset($review->user->icon))
                            <img src="https://s3-ap-northeast-1.amazonaws.com/moguri/Guest/icoon-mono.png" width="65" height="60">
                        @else
                            <img src="{{$review->user->icon}}" width="70" height="55">
                        @endif
                        
                    </div>
                    <div class="col">
                        <div>{{$review->user->name}}</div>
                        @include("commons.star", ["rate" => $review->review])
                        
                        <div align="right">カテゴリ：
                            {{$review->category1}}
                                @if($review->category2)
                                    ,{{$review->category2}}
                                @endif
                                @if($review->category3)
                                    ,{{$review->category3}}
                                @endif
                            <span class="phone_area"><br></span>
                            &emsp;時期：{{$month[$review->review_id]}}月
                        </div>
                        <br>
                        <div>{{$review->comment}}</div>
                    </div>
                </div>
                <hr>
            @endforeach
            {{$reviews->render('pagination::bootstrap-4')}}
        </div>
        <aside class="pc_area">
            @include("commons.sidemenu")
        </aside>
    </div>
    <script>
        var point = {!! json_encode($point) !!}
    </script>
    <script src="/js/googleMap.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATubpo-Sq-u-uWRaIZn7gv84_lwCNzRK8&callback=initMap"></script>
@endsection
