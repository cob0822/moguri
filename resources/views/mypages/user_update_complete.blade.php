@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            ユーザー情報を以下の内容に変更しました
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3 class="mb-5">MYページ - ユーザー情報編集完了</h3>
            
                <p>ユーザー名 : <strong>{{$user->name}}</strong></p>
                
                <p class="mt-4">メールアドレス : <strong>{{$user->email}}</strong></p>

        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
