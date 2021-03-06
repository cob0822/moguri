@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            編集したい項目を入力してください
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3 class="pc_area">MYページ - ユーザー情報編集</h3>
            <h5 class="phone_area">MYページ - ユーザー情報編集</h5>
            <hr>
            <p></p>
            {!! Form::open(["route" => ["changeInformation", $user->id], "enctype" => "multipart/form-data"]) !!}
            
            
                <p>現在登録しているユーザー名 : <strong>{{$user->name}}</strong></p>
                
                <div class="form-group">
                    {!! Form::label("name", "変更後のユーザー名 : ") !!}
                    {!! Form::text("name", old("name"), ["form-control"]) !!}
                </div>
                
                <p class="mt-4">現在登録しているメールアドレス : <strong>{{$user->email}}</strong></p>
                
                <div class="form-group">
                    {!! Form::label("email", "変更後のメールアドレス : ") !!}
                    {!! Form::email("email", old("email"), ["form-control"]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label("icon", "アイコンの登録", ['class' => 'control-label']) !!}
                        <span>：&emsp;</span>
                        {!! Form::file("icon", ["form-control"]) !!}
                </div>            
            
                <br>
            
                {!! Form::submit("入力した内容に変更", ["class" => "btn btn-warning"]) !!}
            {!! Form::close() !!}
        <br>
        </div>
        <aside class="pc_area">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
