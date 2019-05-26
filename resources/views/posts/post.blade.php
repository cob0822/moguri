@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            投稿するポイントに行った時期と、見た物(カテゴリ)を入力してください
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3 class="pb-3">投稿</h3>
            
            <span><strong>地名や郵便番号から住所を検索　※任意</strong></span>
            <!--ツールチップ-->
            <span class="cp_tooltip">&emsp;<i class="far fa-question-circle"></i><span class="cp_tooltiptext">地名を入力する場合、住所の入力は不要です。<br>郵便番号を入力すると、住所が自動的に入力されます。</span></span>
            
            
            {!! Form::open(["route" => "post.confirm", "enctype" => "multipart/form-data"]) !!}
            <br>
                <div class="form-group">
                    &emsp;{!! Form::label("pointname", "地名　※任意") !!}
                    {!! Form::text("pointname", old("pointname"), ["placeholder" => "例）伊豆海洋公園", "form-control"]) !!}
                </div>
                
                <div class="form-group">
                    &emsp;{!! Form::label("address", "郵便番号　※任意") !!}
                    <!-- ▼郵便番号入力フィールド(3桁+4桁) -->
                    <input type="text" name="zip31" size="4" maxlength="3"> － <input type="text" name="zip32" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip31','zip32','pref31','addr31','strt31');">
                    <!-- {!! Form::text("address", old("address"), ["form-controll"]) !!} -->
                </div>
                
                <div class="form-group">
                    <strong>{!! Form::label("address", "住所　※必須(地名入力時は不要)") !!}</strong>
                    <!--ツールチップ-->
                    <span class="cp_tooltip">&emsp;<i class="far fa-question-circle"></i><span class="cp_tooltiptext">都道府県名は"県"や"都"まで入力してください。</span></span><br>
                        
                        <!--詳細画面からの遷移で、住所情報をすでに持っている場合-->
                        @if(isset($prefecture) and isset($belowPrefecture))
                            <!-- ▼住所入力フィールド(都道府県) -->
                            <p>&emsp;都道府県：<input type="text" name="pref31" size="10" value="<?=$prefecture?>"></p>
                            <!-- ▼住所入力フィールド(都道府県以降の住所) -->
                            <p>&emsp;以降の住所：<input type="text" name="addr31"."strt31" size="50" value="<?=$belowPrefecture?>"></p>
                            <!-- {!! Form::text("address", old("address"), ["form-controll"]) !!} -->
                        <!--サイドバーからの遷移等、住所情報を持っていない場合-->
                        @else
                            <!-- ▼住所入力フィールド(都道府県) -->
                            <p>&emsp;都道府県：<input type="text" name="pref31" size="10"></p>
                            <!-- ▼住所入力フィールド(都道府県以降の住所) -->
                            <p>&emsp;以降の住所：<input type="text" name="addr31" size="50"></p>
                            <!-- {!! Form::text("address", old("address"), ["form-controll"]) !!} -->
                        @endif
                </div>
    
    
                <p><strong>画像のアップロード　※任意、3枚まで</strong></p>
                
                <div class="row">
                    <div class="col-3">
                        {!! Form::label("image1", "1枚目　※任意", ['class' => 'control-label']) !!}
                        {!! Form::file("image1", ["form-control"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label("image2", "2枚目　※任意", ['class' => 'control-label']) !!}
                        {!! Form::file("image2", ["form-control"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label("image3", "3枚目　※任意", ['class' => 'control-label']) !!}
                        {!! Form::file("image3", ["form-control"]) !!}
                    </div>
                </div>      
                
                
                <br>
                <p><strong>時期　※必須</strong></p>
                <div class="row">
                    <div class="col-1 col-lg-1">
                        <select name="month">
                            <option value="">-</option>
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
                
                <span><strong>カテゴリ(何を見ましたか?)　※1つ以上必須、3つまで</strong></span>
                
                <!--ツールチップ-->
                <span class="cp_tooltip">&emsp;<i class="far fa-question-circle"></i><span class="cp_tooltiptext">カテゴリ名の重複を避けるため、登録したいカテゴリが<br>プルダウン(入力時の予想検索)に存在する場合は、<br>その名称で登録をお願いいたします。</span></span>
                
                
                <!-- ここのbrが効かない -->
                <br>
                
                
                <div class="row">
                    <div class="col-3">カテゴリ1　※必須</div>
                    <div class="col-3">カテゴリ2　※任意</div>
                    <div class="col-3">カテゴリ3　※任意</div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <input type="text" name="category1" list="category1" placeholder="入力 or 選択">
                              <datalist id="category1">
                                <!--categorymonths tableからカテゴリ一覧を取得-->
                                <!--配列が多重になっているので、foreachを２回回している-->
                                @foreach($categories as $categoryNum)
                                    @foreach($categoryNum as $category)
                                        <option value={{$category}}>
                                    @endforeach
                                @endforeach
                              </datalist>
                    </div>
                    <!--既に選択したカテゴリは表示しないようにするか、カテゴリが重複した場合はバリデーションで引っ掛ける -->
                    <div class="col-3">
                        <input type="text" name="category2" list="category2" placeholder="入力 or 選択">
                              <datalist id="category2">
                                <!--categorymonths tableからカテゴリ一覧を取得-->
                                <!--配列が多重になっているので、foreachを２回回している-->
                                @foreach($categories as $categoryNum)
                                    @foreach($categoryNum as $category)
                                            <option value={{$category}}>
                                    @endforeach
                                @endforeach
                              </datalist>
                    </div>
                    <!--既に選択したカテゴリは表示しないようにするか、カテゴリが重複した場合はバリデーションで引っ掛ける -->
                    <div class="col-3">
                        <input type="text" name="category3" list="category3" placeholder="入力 or 選択">
                              <datalist id="category3">
                                <!--categorymonths tableからカテゴリ一覧を取得-->
                                <!--配列が多重になっているので、foreachを２回回している-->
                                @foreach($categories as $categoryNum)
                                    @foreach($categoryNum as $category)
                                        <option value={{$category}}>
                                    @endforeach
                                @endforeach
                              </datalist>
                    </div>
                </div>
                
                <br>
                <p><strong>レビュー　※必須</strong></p>
                <select name="review">
                    <option value="">-</option>
                    <option value="5">☆☆☆☆☆</option>
                    <option value="4">☆☆☆☆</option>
                    <option value="3">☆☆☆</option>
                    <option value="2">☆☆</option>
                    <option value="1">☆</option>
                </select>
                
                <!--ここもなぜか改行が効かないのでpタグで改行 -->
                <br><p></p>
                <div class="form-group">
                    <strong>{!! Form::label("comment", "コメント(300文字まで)　※必須") !!}</strong><br>
                    {!! Form::textarea("comment", old("comment"), ["form-control"]) !!}
                </div>
                
                {!! Form::submit("次へ", ["class" => "btn btn-warning"]) !!}
                
            {!! Form::close() !!}
            <br>
        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
