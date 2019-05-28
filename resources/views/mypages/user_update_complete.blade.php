@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            ユーザー情報を以下の内容に変更しました
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3 class="pc_area">MYページ - ユーザー情報編集完了</h3>
            <h5 class="phone_area">MYページ - ユーザー情報編集完了</h5>
            <hr>
                <p>ユーザー名 : <strong>{{$user->name}}</strong></p>
                
                <p class="mt-4">メールアドレス : <strong>{{$user->email}}</strong></p>
        <br>
        {!! link_to_route("top", "TOPへ", [], ["class" => "btn btn-warning"]) !!}
        </div>
        <aside class="pc_area">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
