@extends("layouts.app")

@section("content")
    <div class="text-center">
        <h3>ユーザー登録</h3>
    </div>
    
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            
            {!! Form::open(["route" => "signup.post"]) !!}
                <div class="form-group">
                    {!! Form::label("name", "ユーザー名") !!}
                    {!! Form::text("name", old("name"), ["class" => "form-control"]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label("email", "メールアドレス") !!}
                    {!! Form::email("email", old("email"), ["class" => "form-control"]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label("password", "パスワード") !!}
                    {!! Form::password("password", ["class" => "form-control"]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label("password_confirmation", "パスワード(確認)") !!}
                    {!! Form::password("password_confirmation", ["class" => "form-control"]) !!}
                </div>
                
                {!! Form::submit("上記の内容で登録", ["class" => "btn btn-primary btn-block"]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection