@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            
        </div>
    @endsection
    
    <div class="row">
        <div class="col-8">
            <h3>ポイントの検索</h3>
            
            {!! Form::open(["route" => "searching"]) !!}
            
                <div class="row pt-4">
                    <div class="col-4 lg-4">
                        <p>何が見たいですか? (必須)</p>
                        
                        <input type="text" name="category" list="category" placeholder="入力 or 選択">
                          <datalist id="category">
                              
                            <!--categoryMonths tableからカテゴリ一覧を取得-->
                            <!--配列が多重になっているので、foreachを２回回している-->
                            @foreach($categories as $categoryNum)
                                @foreach($categoryNum as $category)
                                    <option value={{$category}}>
                                @endforeach
                            @endforeach
                            
                          </datalist>
                    </div>
                    <div class="col-4 lg-4">
                        <p>時期 (任意)</p>
                    
                        <div class="row">
                            <div class="col-3 col-lg-3">
                                <select name="month">
                                    <option value="-">-</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="4">3</option>
                                    <option value="8">4</option>
                                    <option value="16">5</option>
                                    <option value="32">6</option>
                                    <option value="64">7</option>
                                    <option value="128">8</option>
                                    <option value="256">9</option>
                                    <option value="512">10</option>
                                    <option value="1024">11</option>
                                    <option value="2048">12</option>
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
                            <option value="-">-</option>
                            <option value="kanto">関東</option>
                            <option value="tokyo">東京</option>
                            <option value="kanagawa">神奈川</option>
                            <option value="chiba">千葉</option>
                            <option value="kyusyu">九州</option>
                            <option value="nagasaki">長崎</option>
                            <option value="okinawa">沖縄</option>
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
        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
