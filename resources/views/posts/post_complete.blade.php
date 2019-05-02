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
            
            <p>住所</p>
            <p>画像</p>
            <p>時期</p>
            <p>カテゴリ</p>
            <p>レビュー</p>
            <p>コメント</p>
            
            <!-- テスト用のボタン-->
            <a href="/">TOPに戻る</a>
            {!! link_to_route("detail", "投稿したポイントの詳細を見る") !!}
            
            
        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
