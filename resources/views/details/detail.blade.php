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
                        <div class="card">
                            <br>
                            <br>
                            <br>                            
                            ここにグーグルマップを出す
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                    <div class="col">
                        {{$point->prefecture}}
                        {{$point->belowPrefecture}}
                        <br>
                        <br>
                        <!--本来はDBからデータ取得はコントローラに記述すべき -->
                        レビュー： {{\DB::table("reviews")->where("point_id", $point->id)->avg("review")}}
                        <span class="ml-2">{{\DB::table("reviews")->where("point_id", $point->id)->count("review")}}件の投稿</span>
                        
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-3">
                                {!! link_to_route("post", "投稿する", ["class" => "btn btn-warning"]) !!}
                            </div>
                            <div class="col-4">
                                @include("users.favorite_button")
                            </div>
                            <div class="col-5">
                                付近のショップを見る
                            </div>
                        </div>  
                          
                    </div>    
                </div>
            <hr>
                <!--画像一覧を表示する -->
                <div class="jumbotron">ここに画像一覧を表示する</div>
            <hr>
            
            @foreach($point->reviews as $review) 
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <!--アイコンを表示する -->
                            ここにアイコンを表示する
                        </div>
                    </div>
                    <div class="col">
                        <div>{{$review->user->name}}</div>
                        <span>{{$review->review}}</span>
                        
                        
                        <!--カテゴリ２と３がない場合,を表示しないように修正する -->
                        <div align="right">カテゴリ：{{$review->category1}},{{$review->category2}},{{$review->category3}}&emsp;時期：{{$review->month}}</div>
                        <div>{{$review->comment}}</div>
                    </div>
                </div>
                <hr>
            @endforeach
            
            
            

        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
