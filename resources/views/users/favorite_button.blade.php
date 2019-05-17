@if(Auth::check())
    @if(Auth::user()->is_favorite($point->id))
        {!! Form::open(["route" => ["unfavorite", $point->id], "method" => "delete"]) !!}
            {!! Form::submit("お気に入りから削除", ["class" => "btn btn-danger btn-sm"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(["route" => ["favorite", $point->id]]) !!}
            {!! Form::submit("お気に入りに追加", ["class" => "btn btn-primary btn-sm"]) !!}
        {!! Form::close() !!}
    @endif
@else
    <div class="btn btn-primary disabled">
        お気に入りに追加
    </div>
@endif
