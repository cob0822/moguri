@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3><strong>{{$category}}</strong>の検索結果</h3>
            
            <!-- 該当のポイントが１件もない場合は、その旨のメッセージを表示する ※isset($points[0]) -> $points配列の先頭にデータがセットされている場合 -->
            @if(isset($points[0]))
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
                            レビュー： {{\DB::table("reviews")->where("point_id", $point->point_id)->avg("review")}}
                            <span class="ml-2">{{\DB::table("reviews")->where("point_id", $point->point_id)->count("review")}}件の投稿</span>
                            <br>
                            <br>
                            <br>
                            <p align="right">{!! link_to_route("detail", "詳細を見る", ["id" => $point->point_id, "category" => $category]) !!}</p>
                        </div>    
                    </div>
                @endforeach
                <hr>
            @else
                <hr>
                <div>該当するポイントが見つかりませんでした。</div>
            @endif
        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
