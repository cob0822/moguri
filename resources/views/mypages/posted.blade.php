@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            
        </div>
    @endsection
    
    <div class="row">
        <div class="col-8">
            <h3>MYページ - 過去の投稿</h3>
            
            @if($posts)
                @foreach($posts as $post)
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
                                <div class="row">
                                    <div class="col-3">
                                        ここに画像を出す
                                    </div>
                                </div>
                            <div class="col">
                                
                                {{$post->point()->prefecture}}
                                {{$post->point()->belowPrefecture}}
                                
                                
                                
                                
                                
                                <br>
                                <br>
                                <!--本来はDBからデータ取得はコントローラに記述すべき -->
                                レビュー： {{$post->review}}
                                <br>
                                {{$post->comment}}
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                        編集ボタン
                                    </div>
                                    <div class="col-4">
                                        @include("users.favorite_button", ["point" => $post->point])
                                    </div>
                                    <div class="col-5">
                                        付近のショップを見る
                                    </div>
                                </div>  
                                  
                            </div>    
                        </div>
                    <hr>
                @endforeach
            @else
                <hr>
                <div>過去の投稿がありません。</div>
            @endif
        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
