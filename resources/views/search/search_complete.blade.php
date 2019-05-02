@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            地域と時期でフィルターをかけられます
        </div>
    @endsection
    
    <div class="row">
        <div class="col-8">
            <h3><strong>マナティー（仮）</strong>の検索結果</h3>
            
            <!-- テスト用 -->
            {!! link_to_route("detail", "詳細を見る（仮）") !!}
        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
