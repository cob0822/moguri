@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            お問い合わせいただきありがとうございました<br>
            下記の内容で送信が完了しました
        </div>
    @endsection
    
    <div class="row">
        <div class="col-8">
            <h3>お問い合わせ完了</h3>
            
            <h4>お問い合わせ内容</h4>
            
            
            <!-- テスト用 -->
            <a href="/">TOPに戻る</a>
        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
