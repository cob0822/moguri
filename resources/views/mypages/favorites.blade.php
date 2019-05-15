@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3>MYページ - お気に入りポイント</h3>
            
            @if(isset($favorites[0]))
                @foreach($favorites as $favorite)
                <hr>
                    <div class="row">
                        <div class="col-3">
                            <div class="card">
                                <br>
                                <br>
                                <br>                            
                                ここにグーグルマップを出す
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                        <div class="col">
                            {{$favorite->prefecture}}
                            {{$favorite->belowPrefecture}}
                            
                            <!--本来はDBからデータ取得はコントローラに記述すべき -->
                            <div class="row">
                                <div class="col-5 col-md-3">
                                @include("commons.star", ["rate" => $rateAvg[$favorite->id]])
                                </div>
                                <div class="col">
                                <span class="ml-2">{{\DB::table("reviews")->where("point_id", $favorite->id)->count("review")}}件の投稿</span>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <p align="right">{!! link_to_route("favorites_to_detail", "詳細を見る", ["id" => $favorite->id]) !!}</p>
                        </div>    
                    </div>
                @endforeach
                <hr>
            @else
                <hr>
                <div>該当するポイントが見つかりませんでした。</div>
            @endif
        {{$favorites->render('pagination::bootstrap-4')}}
        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
