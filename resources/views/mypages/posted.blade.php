@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            「編集」ボタンからレビュー内容を編集できます
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3 class="pc_area">MYページ - 過去の投稿</h3>
            <h5 class="phone_area">MYページ - 過去の投稿</h5>
            
            @if($reviews_points)
                @foreach($reviews_points as $post)
                    <hr>
                        <div class="row">
                            <div class="col-5 col-md-3">
                                
                                <div class="googleMap" id="googleMap{{$post->id}}{{$post->review_id}}"></div>
                                
                                @if(isset($post->image1))
                                    <img src="{{$post->image1}}" width="50" height="40">
                                @endif
                                @if(isset($post->image2))
                                    <img src="{{$post->image2}}" width="50" height="40">
                                @endif
                                @if(isset($post->image3))
                                    <img src="{{$post->image3}}" width="50" height="40">
                                @endif
                                
                                <div class="pt-3 pl-1">{!! link_to_route("posted_to_detail", "詳細を見る", ["id" => $post->point_id]) !!}</div>
                                
                            </div>
                            <div class="col-7 col-md-9">
                                {{$post->prefecture}}
                                {{$post->belowPrefecture}}
                                <br>
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <!--レビューの星取得 -->
                                        @include("commons.star", ["rate" => $post->review])
                                    </div>
                                </div>
                                <br>
                                カテゴリ：{{$post->category1}}
                                @if($post->category2)
                                    ,{{$post->category2}}
                                @endif
                                @if($post->category3)
                                    ,{{$post->category3}}
                                @endif
                                <span class="phone_area"><br></span>
                                <span class="pc_area">&emsp;</span>
                                時期：{{$months[$post->review_id]}}月
                                <br>
                                <br>
                                {{$post->comment}}
                                <br>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <!-- モーダルの表示 -->
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$post->review_id}}">
                                            編集
                                        </button>
                                        <div class="modal" id="exampleModal{{$post->review_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">投稿の編集</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span>住所</span><br>
                                                        &emsp;{{$post->prefecture}}{{$post->belowPrefecture}}<br><br>
                                                        <span>時期</span><br>
                                                        &emsp;{{$months[$post->review_id]}}月<br><br>
                                                        <span>カテゴリ</span><br>
                                                        &emsp;{{$post->category1}}
                                                        @if($post->category2)
                                                            ,{{$post->category2}}
                                                        @endif
                                                        @if($post->category3)
                                                            ,{{$post->category3}}
                                                        @endif
                                                        <br><br>
                                                        {!! Form::open(["route" => ["post.modify", $post->review_id]]) !!}
                                                        
                                                            <span>レビュー</span><br>
                                                            <select name="review">
                                                                <option value="">-</option>
                                                                <option value="5">☆☆☆☆☆</option>
                                                                <option value="4">☆☆☆☆</option>
                                                                <option value="3">☆☆☆</option>
                                                                <option value="2">☆☆</option>
                                                                <option value="1">☆</option>
                                                            </select>
                                                            <br><br>
                                                            <div class="form-group">
                                                                {!! Form::label("comment", "コメント") !!}<br>
                                                                {!! Form::textarea("comment", old("comment"), ["form-control", "cols" => "40", "rows" => "7"]) !!}
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                            {!! Form::submit("変更", ["class" => "btn btn-warning"]) !!}
                                                        {!! Form::close() !!}
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- モーダルここまで -->

                                    <div class="col-12 col-md-4 pc_area">
                                        @include("users.favorite_button", ["point" => $post])
                                    </div>
                                    <div class="col-12 phone_area mt-4">
                                        @include("users.favorite_button", ["point" => $post])
                                    </div>
                                    <div class="col-12 col-md-5 pc_area">
                                        <div class="btn btn-primary disabled">
                                            <s>付近のショップを見る</s>
                                        </div>
                                    </div>
                                </div>  
                                 
                            </div>    
                        </div>
                @endforeach
            @else
                <hr>
                <div>過去の投稿がありません。</div>
            @endif
            <hr>
            {{$reviews_points->render('pagination::bootstrap-4')}}
        </div>
        <aside class="pc_area">
            @include("commons.sidemenu")
        </aside>
    </div>
    <script>
        var points = {!! json_encode($reviews_points->toArray()) !!}
    </script>
    <script src="/js/googleMapsForPosted.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATubpo-Sq-u-uWRaIZn7gv84_lwCNzRK8&callback=initMap"></script>
@endsection
