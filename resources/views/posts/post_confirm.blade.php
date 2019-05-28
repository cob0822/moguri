@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            以下の内容で投稿します
        </div>
    @endsection

    <div class="row">
        <div class="col-12 col-md-8">
            <h3 class="pc_area">投稿確認</h3>
            <h5 class="phone_area">投稿確認</h5>
            <hr>
            <br>
            <p>住所：{{$prefecture}}{{$belowPrefecture}}</p>
            <p>画像：
            @if(!isset($image1URL) and !isset($image2URL) and !isset($image3URL))
                なし
            @endif
            
            <br>
            
            @if(isset($image1URL))
                <img src="{{$image1URL}}" width="195" height="150">
            @endif
            @if(isset($image2URL))
                <img src="{{$image2URL}}" width="195" height="150">
            @endif
            @if(isset($image3URL))
                <img src="{{$image3URL}}" width="195" height="150">
            @endif
            
            </p>
            <p>時期：
                @if($month == 1)
                    1月
                @elseif($month == 2)
                    2月
                @elseif($month == 4)
                    3月
                @elseif($month == 8)
                    4月
                @elseif($month == 16)
                    5月
                @elseif($month == 32)
                    6月
                @elseif($month == 64)
                    7月
                @elseif($month == 128)
                    8月
                @elseif($month == 256)
                    9月
                @elseif($month == 512)
                    10月
                @elseif($month == 1024)
                    11月
                @else
                    12月
                @endif
            </p>
            <p>カテゴリ：
                @foreach($categories as $category)
                    @if(isset($category))
                        @if($category == reset($categories))
                            {{$category}}
                        @elseif($category != reset($categories))
                            ,{{$category}}
                        @endif
                    @endif
                @endforeach
            </p>
            <span>レビュー：@include("commons.star", ["rate" => $review])</span>
            <br>
            <p>コメント：{{$comment}}</p>
            <br>
            <div class="row">
                <div class="col-4">
                    <!--セッションで値を保持して戻り画面に初期表示したい -->
                    {!! link_to_route("post", "戻る", [], ["class" => "btn btn-warning"]) !!}
                </div>
                <div class="col">
                    {!! Form::open(["route" => ["post.complete"]]) !!}
                        {!! Form::submit("投稿", ["class" => "btn btn-warning"]) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <br>
        </div>
        <aside class="pc_area">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
