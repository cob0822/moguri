@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            
        </div>
    @endsection
    
    <div class="row">
        <div class="col-8">
            <h3>人気のポイントランキング</h3>

            @foreach($points as $point)
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
                        {{$point->prefecture}}
                        {{$point->belowPrefecture}}
                        <br>
                        <br>
                        <!--本来はDBからデータ取得はコントローラに記述すべき -->
                        レビュー： {{\DB::table("reviews")->where("point_id", $point->id)->avg("review")}}
                        <span class="ml-2">{{\DB::table("reviews")->where("point_id", $point->id)->count("review")}}件の投稿</span>
                        <br>
                        <br>
                        <br>
                        
                        
                        <!--カテゴリは指定なしでリクエストする必要があるので、修正する -->
                        
                        <p align="right">{!! link_to_route("ranking_to_detail", "詳細を見る", ["id" => $point->id]) !!}</p>
                        
                        
                        
                        
                    </div>    
                </div>
            @endforeach
            <hr>
        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
