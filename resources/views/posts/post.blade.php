@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            投稿するポイントに行った時期と、見た物(カテゴリ)を入力してください
        </div>
    @endsection
    
    <div class="row">
        <div class="col-8">
            <h3 class="pb-3">投稿</h3>
            
            <h6><strong>地名や郵便番号から住所を検索　※任意</strong></h6>
            
            <!-- ここはツールチップにしたい-->
            <p>※地名、郵便番号のいずれかから住所を自動入力できます。（ツールチップにする）</p>
            
            
            <div class="form-group">
                {!! Form::label("pointname", "地名から住所を検索　※任意") !!}
                {!! Form::text("pointname", old("pointname"), ["form-control"]) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label("address", "郵便番号　※任意") !!}
                <!-- ▼郵便番号入力フィールド(3桁+4桁) -->
                <input type="text" name="zip31" size="4" maxlength="3"> － <input type="text" name="zip32" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip31','zip32','pref31','addr31','addr31');">
                <!-- {!! Form::text("address", old("address"), ["form-controll"]) !!} -->
            </div>
            
            <div class="form-group">
                <strong>{!! Form::label("address", "住所　※必須") !!}</strong><br>
                    <!-- ▼住所入力フィールド(都道府県) -->
                    <p>都道府県：<input type="text" name="pref31" size="10"></p>
                    <!-- ▼住所入力フィールド(都道府県以降の住所) -->
                    <p>以降の住所：<input type="text" name="addr31" size="50"></p>
                <!-- {!! Form::text("address", old("address"), ["form-controll"]) !!} -->
            </div>

            <p><strong>画像のアップロード　※任意、3枚まで</strong></p><br>
            
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
            
            <p><strong>カテゴリ(何を見ましたか?)　※1つ以上必須、3つまで</strong></p>
            
            <!--ここもツールチップにする -->
            <p>カテゴリ名の重複を避けるため、登録したいカテゴリがプルダウン(入力時の予想検索)に存在する場合は、その名称で登録をお願いいたします。</p>
            
            <div class="row">
                <div class="col-3">カテゴリ1　※必須</div>
                <div class="col-3">カテゴリ2　※任意</div>
                <div class="col-3">カテゴリ3　※任意</div>
            </div>
            <div class="row">
                <div class="col-3">
                    <input type="text" name="category1" list="category1" placeholder="入力 or 選択">
                          <datalist id="category1">
                            <!--categoryMonths tableからカテゴリ一覧を取得-->
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
                            <!--categoryMonths tableからカテゴリ一覧を取得-->
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
                            <!--categoryMonths tableからカテゴリ一覧を取得-->
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
            <select name="area">
                <option value="">-</option>
                <option value="5">☆☆☆☆☆</option>
                <option value="4">☆☆☆☆</option>
                <option value="3">☆☆☆</option>
                <option value="2">☆☆</option>
                <option value="1">☆</option>
            </select>
            
            <div class="form-group">
                <strong>{!! Form::label("comment", "コメント　※必須") !!}</strong><br>
                {!! Form::textarea("comment", old("comment"), ["form-control"]) !!}
            </div>
            
            <!-- テスト用の投稿完了ボタン-->
            {!! link_to_route("posting", "投稿（テスト）") !!}
            
        </div>
        <aside class="col-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
