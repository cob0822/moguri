@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="text-white small">
            お問い合わせ内容は管理者のメールアドレスに送信されます
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <h3>お問い合わせ</h3>
            <br>
            
            {!! Form::open(["route" => "querying"]) !!}
            
            @if(\Auth::check())
                <div class="form-group">
                    {!! Form::label("inquiry", "お問い合わせ内容(300文字以内)") !!}
                    <br>
                    {!! Form::textarea("inquiry", old("inquiry"), ["form-control"]) !!}
                </div>
            @else
                <div class="form-group">
                    {!! Form::label("email", "メールアドレス") !!}
                    <br>
                    {!! Form::email("email", old("email"), ["form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("inquiry", "お問い合わせ内容(300文字以内)") !!}
                    <br>
                    {!! Form::textarea("inquiry", old("inquiry"), ["form-control"]) !!}
                </div>
            @endif
            
            {!! Form::submit("上記の内容で問い合わせる", ["class" => "btn btn-warning"]) !!}

        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
