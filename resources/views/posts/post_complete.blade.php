@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            以下の内容で投稿が完了しました
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3>投稿完了</h3>
            
            <p>住所:&emsp;{{$data["prefecture"]}}{{$data["belowPrefecture"]}}</p>
            <p>画像</p>
            <p>時期:&emsp;
                @if($data["month"] == 1)
                    1月
                @elseif($data["month"] == 2)
                    2月
                @elseif($data["month"] == 4)
                    3月
                @elseif($data["month"] == 8)
                    4月
                @elseif($data["month"] == 16)
                    5月
                @elseif($data["month"] == 32)
                    6月
                @elseif($data["month"] == 64)
                    7月
                @elseif($data["month"] == 128)
                    8月
                @elseif($data["month"] == 256)
                    9月
                @elseif($data["month"] == 512)
                    10月
                @elseif($data["month"] == 1024)
                    11月
                @else
                    12月
                @endif
            </p>
            <p>カテゴリ:&emsp;
                @foreach($data["categories"] as $category)
                    @if(isset($category))
                        {{$category}}&emsp;
                    @endif
                @endforeach
            </p>
            <p>レビュー:&emsp;{{$data["review"]}}</p>
            <p>コメント:&emsp;{{$data["comment"]}}</p>
            <br>
            {!! link_to_route("post", "投稿TOPへ", [], ["class" => "btn btn-warning"]) !!}
            &ensp;
            {!! link_to_route("top", "TOPへ", [], ["class" => "btn btn-warning"]) !!}
            &ensp;
            @if(\Auth::check())
                {!! link_to_route("mypost", "過去の投稿へ", [], ["class" => "btn btn-warning"]) !!}
            @endif
        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
