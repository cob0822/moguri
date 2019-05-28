@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            以下の内容で投稿が完了しました
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3 class="pc_area">投稿完了</h3>
            <h5 class="phone_area">投稿完了</h5>
            <hr>
            <br>
            <p>住所：{{$data["prefecture"]}}{{$data["belowPrefecture"]}}</p>
            <p>画像：
            @if(!isset($data["image1URL"]) and !isset($data["image2URL"]) and !isset($data["image3URL"]))
                なし
            @endif
            
            <br>
            
            @if(isset($data["image1URL"]))
                <img src="{{$data["image1URL"]}}" width="195" height="150">
            @endif
            @if(isset($data["image2URL"]))
                <img src="{{$data["image2URL"]}}" width="195" height="150">
            @endif
            @if(isset($data["image3URL"]))
                <img src="{{$data["image3URL"]}}" width="195" height="150">
            @endif
            </p>
            
            <p>時期：
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
            <p>カテゴリ：
            <!--
                @foreach($data["categories"] as $category)
                    @if(isset($category))
                        {{$category}}&emsp;
                    @endif
                @endforeach
            -->
                
                @foreach($data["categories"] as $category)
                    @if(isset($category))
                        @if($category == reset($data["categories"]))
                            {{$category}}
                        @elseif($category != reset($data["categories"]))
                            ,{{$category}}
                        @endif
                    @endif
                @endforeach
            </p>
            <span>レビュー：@include("commons.star", ["rate" => $data["review"]])</span>
            <br>
            <p>コメント：{{$data["comment"]}}</p>
            <br>
            {!! link_to_route("post", "投稿TOPへ", [], ["class" => "btn btn-warning"]) !!}
            &ensp;
            {!! link_to_route("top", "TOPへ", [], ["class" => "btn btn-warning"]) !!}
            &ensp;
            @if(\Auth::check())
                {!! link_to_route("mypost", "過去の投稿へ", [], ["class" => "btn btn-warning"]) !!}
            @endif
        </div>
        
        <aside class="pc_area">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
