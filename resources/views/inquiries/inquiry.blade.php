@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            お問い合わせ内容は管理者のメールアドレスに送信されます
        </div>
    @endsection
    
    <div class="row">
        <div class="col-8">
            <h3>お問い合わせ</h3>
            
            <h4>お問い合わせ内容</h4>
            
            
            <!-- テスト用 -->
            {!! link_to_route("querying", "上記の内容で問い合わせる（仮）") !!}
        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
