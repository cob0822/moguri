@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            以下の項目に1つ以上入力して検索
        </div>
    @endsection
    
    <div class="row">
        <div class="col-8">
            <h3>ポイントの検索</h3>
            
            {!! Form::open(["route" => "searching"]) !!}
            
                <div class="row pt-4">
                    <div class="col-4 lg-4">
                        <p>何が見たいですか? (必須)</p>
                        
                        <!--以下のプルダウンフォームはHTMLのベタ書きなので、Laravelの書き方に変更する -->
                        <form action="#">
                        <input type="text" name="category" list="category" placeholder="入力 or 選択" autocomplete="off">
                          <datalist id="category">
                            <option value="マナティー">
                          　<option value="クジラ">
                          　<option value="沈没船">
                          </datalist>
                        </form>
                    </div>
                    <div class="col-4 lg-4">
                        <p>時期 (任意)</p>
                    
                        <div class="row">
                            <div class="col-3 col-lg-3">
                                <select name="month">
                                    <option value="">-</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="col">
                                <p>月</p>
                            </div>
                        </div>
    
                    </div>
                    <div class="col-4 lg-4">
                        <p>地域 (任意)</p>
                        
                        <!-- オプションを追加する -->
                        <select name="area">
                            <option value="">-</option>
                            <option value="関東">関東</option>
                            <option value="東京">東京</option>
                            <option value="神奈川">神奈川</option>
                            <option value="千葉">千葉</option>
                            <option value="九州">九州</option>
                            <option value="長崎">長崎</option>
                            <option value="沖縄">沖縄</option>
                            <option value="">・・・</option>
                        </select>
                    </div>
                </div>
            
            <div class="row">
                <div class="col-offset-2 col-10">
                    {!! Form::submit("検索", ["class" => "btn btn-primary"]) !!}
                </div>
            </div>
            {!! Form::close() !!}
            
            <!-- テスト用の検索結果ボタン-->
            {!! link_to_route("searching", "検索（テスト）") !!}
            
        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
