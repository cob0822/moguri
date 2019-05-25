@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            「編集」ボタンからレビュー値とコメントを編集できます
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3>MYページ - 過去の投稿</h3>
            
            @if($reviews_points)
                @foreach($reviews_points as $post)
                    <hr>
                        <div class="row">
                            <div class="col-3">
                                
                                
                                
                                <div class="googleMap" id="googleMap{{$post->id}}"></div>
                                
                                
                                
                                
                                @if(isset($post->image1))
                                    <img src="{{$post->image1}}" width="50" height="40">
                                @endif
                                @if(isset($post->image2))
                                    <img src="{{$post->image2}}" width="50" height="40">
                                @endif
                                @if(isset($post->image3))
                                    <img src="{{$post->image3}}" width="50" height="40">
                                @endif
                                    
                                    
                            </div>
                            <div class="col">
                                {{$post->prefecture}}
                                {{$post->belowPrefecture}}
                                <br>
                                <!--レビューの星取得 -->
                                @include("commons.star", ["rate" => $post->review])
                                
                                <br>
                                カテゴリ：{{$post->category1}}
                                @if($post->category2)
                                    ,{{$post->category2}}
                                @endif
                                @if($post->category3)
                                    ,{{$post->category3}}
                                @endif
                                &emsp;時期：{{$post->month}}月
                                <br>
                                <br>
                                {{$post->comment}}
                                <br>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-4 col-md-2">
                                        <!-- モーダルの表示 -->
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$post->id}}">
                                            編集
                                        </button>
                                        <div class="modal" id="exampleModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        &emsp;{{$post->month}}月<br><br>
                                                        <span>カテゴリ</span><br>
                                                        &emsp;{{$post->category1}}
                                                        @if($post->category2)
                                                            ,{{$post->category2}}
                                                        @endif
                                                        @if($post->category3)
                                                            ,{{$post->category3}}
                                                        @endif
                                                        <br><br>
                                                        {!! Form::open(["route" => ["post.modify", $post->id]]) !!}
                                                            <span>レビュー</span><br>
                                                            <select name="review">
                                                                <option value="">-</option>
                                                                <option value="5">☆☆☆☆☆</option>
                                                                <option value="4">☆☆☆☆</option>
                                                                <option value="3">☆☆☆</option>
                                                                <option value="2">☆☆</option>
                                                                <option value="1">☆</option>
                                                            </select>
                                                            <br>
                                                            <div class="form-group">
                                                                <strong>{!! Form::label("comment", "コメント") !!}</strong><br>
                                                                {!! Form::textarea("comment", old("comment"), ["form-control"]) !!}
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
                                    <div class="col-4 col-md-4">
                                        @include("users.favorite_button", ["point" => $post])
                                    </div>
                                    <div class="col-12 col-md-4">
                                        付近のショップを見る
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
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
    <script>
        var points = {!! json_encode($reviews_points->toArray()) !!}
    </script>
    <script src="/js/googleMaps.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATubpo-Sq-u-uWRaIZn7gv84_lwCNzRK8&callback=initMap"></script>
@endsection
