@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            編集したい項目を入力してください
        </div>
    @endsection
    
    <div class="row">
        <div class="col-8">
            <h3>MYページ - ユーザー情報編集</h3>
            

        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
