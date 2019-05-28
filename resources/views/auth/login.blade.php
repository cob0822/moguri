@extends('layouts.app')

@section('content')
    @section("test")
        <div class="text-white small">
        パスワードを忘れた場合はお問い合わせください
        </div>
    @endsection
    
    <div class="text-center">
        <h3 class="pc_area">ログイン</h3>
        <h5 class="phone_area">ログイン</h5>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}

            <p class="mt-2">ユーザー登録は{!! link_to_route('signup.get', 'こちら') !!}</p>
        </div>
    </div>
@endsection