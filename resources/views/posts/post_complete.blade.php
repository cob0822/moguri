@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            以下の内容で投稿が完了しました
        </div>
    @endsection
    
    <div class="row">
        <div class="col-8">
            <h3>投稿完了</h3>
            
            <p>住所:&emsp;{{$data["prefecture"]}}</p>
            <p>画像</p>
            <p>時期</p>
            <p>カテゴリ</p>
            <p>レビュー:&emsp;{{$data["review"]}}</p>
            <p>コメント</p>
            
            <!-- テスト用のボタン-->
            
            
        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
