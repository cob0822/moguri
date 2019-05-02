@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            必須項目を入力後、投稿
        </div>
    @endsection
    
    <div class="row">
        <div class="col-8">
            <h3>投稿</h3>
            
            <p>住所(必須)</p>
            <p>地名から住所を検索(任意)</p>
            <p>画像のアップロード(任意、3枚まで)</p>
            <p>時期(必須)</p>
            <p>カテゴリ(1つ以上必須、3つまで)</p>
            <p>レビュー(必須)</p>
            <p>コメント(必須)</p>
            
            <!-- テスト用の投稿完了ボタン-->
            {!! link_to_route("posting", "投稿（テスト）") !!}
            
        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
