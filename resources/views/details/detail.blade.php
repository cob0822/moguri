@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            「お気に入りに追加」機能はログイン後に利用できます
        </div>
    @endsection
    
    <div class="row">
        <div class="col-8">
            <h3><strong>マナティー（仮）</strong>が見られるポイント</h3>
            

        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
