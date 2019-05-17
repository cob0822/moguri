@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            お問い合わせいただきありがとうございました<br>
            下記の内容で送信が完了しました
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3>お問い合わせ完了</h3>
            <br>
            <h5>お問い合わせ内容</h5>
            <br>
            <div>{{$inquiry->inquiry}}</div>
            <br>
            {!! link_to_route("top", "TOPへ", [], ["class" => "btn btn-warning"]) !!}
            
        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
