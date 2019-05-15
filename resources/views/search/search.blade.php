@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            
        </div>
    @endsection
        
    <div class="row">
        <div class="col-12 col-md-8">
            <h3>ポイントの検索</h3>
            
            {!! Form::open(["route" => "searching"]) !!}
            
                <div class="row pt-4">
                    <div class="col-md-4">
                        <span>カテゴリ (必須)</span>
                        <!-- ツールチップ -->
                        <span class="cp_tooltip">&emsp;<i class="far fa-question-circle"></i><span class="cp_tooltiptext">何が見たいですか?</span></span>
                        
                        <!--brが効かないので、pタグで改行している -->
                        <p></p>
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
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <p>地域 (任意)</p>
                        
                        <!-- オプションを追加する -->
                        <select name="area">
                            <option value="-">-</option>
                            <option value="関東地方"><strong>関東</strong></option>
                            <option value="神奈川県">神奈川</option>
                            <option value="千葉県">千葉</option>
                            <option value="東京都">東京</option>
                            <option value="栃木県">栃木</option>
                            <option value="茨城県">茨城</option>
                            <option value="群馬県">群馬</option>
                            <option value="埼玉県">埼玉</option>
                            <option value="沖縄県">沖縄</option>
                            <option value="北海道">北海道</option>
                            <option value="九州地方"><strong>九州</strong></option>
                            <option value="福岡県">福岡</option>
                            <option value="大分県">大分</option>
                            <option value="長崎県">長崎</option>
                            <option value="熊本県">熊本</option>
                            <option value="鹿児島県">鹿児島</option>
                            <option value="宮崎県">宮崎</option>
                            <option value="佐賀県">佐賀</option>
                            <option value="四国地方"><strong>四国</strong></option>
                            <option value="高知県">高知</option>
                            <option value="愛媛県">愛媛</option>
                            <option value="徳島県">徳島</option>
                            <option value="香川県">香川</option>
                            <option value="東北地方"><strong>東北</strong></option>
                            <option value="青森県">青森</option>
                            <option value="秋田県">秋田</option>
                            <option value="岩手県">岩手</option>
                            <option value="山形県">山形</option>
                            <option value="宮城県">宮城</option>
                            <option value="福島県">福島</option>
                            <option value="中部地方"><strong>中部</strong></option>
                            <option value="新潟県">新潟</option>
                            <option value="富山県">富山</option>
                            <option value="石川県">石川</option>
                            <option value="福井県">福井</option>
                            <option value="長野県">長野</option>
                            <option value="岐阜県">岐阜</option>
                            <option value="山梨県">山梨</option>
                            <option value="静岡県">静岡</option>
                            <option value="愛知県">愛知</option>
                            <option value="近畿地方"><strong>近畿</strong></option>
                            <option value="兵庫県">兵庫</option>
                            <option value="京都府">京都</option>
                            <option value="滋賀県">滋賀</option>
                            <option value="大阪府">大阪</option>
                            <option value="奈良県">奈良</option>
                            <option value="和歌山県">和歌山</option>
                            <option value="三重県">三重</option>
                            <option value="中国地方"><strong>中国</strong></option>
                            <option value="山口県">山口</option>
                            <option value="島根県">島根</option>
                            <option value="鳥取県">鳥取</option>
                            <option value="広島県">広島</option>
                            <option value="岡山県">岡山</option>
                        </select>
                    </div>
                </div>
            <br>
            <div class="row">
                <div class="col-offset-2 col-10">
                    {!! Form::submit("検索", ["class" => "btn btn-primary"]) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
