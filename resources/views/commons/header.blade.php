<header id="header" class="mb-4">
    
    @if(Auth::check())
        <div class="fixed-top pt-2 pr-3" style="left:initial;">
            <!--ここにアイコンを出す -->
            @if(isset(\Auth::user()->icon))
                <img src="{{\Auth::user()->icon}}" width="65" height="50">
            @endif
            <span class="pr-3">{{Auth::user()->name}}</span>
            {!! link_to_route("logout.get", "ログアウト", [], ["class" => "btn btn-warning"]) !!}
        </div>
    @else
        <!-- 以下のdivコードは　https://teratail.com/questions/148276　でググった-->
        <div class="fixed-top pt-2 pr-3" style="left:initial;">
            {!! link_to_route("signup.get", "ユーザー登録", [], ["class" => "btn btn-warning"]) !!}
            {!! link_to_route("login", "ログイン", [], ["class" => "btn btn-warning"]) !!}
        </div>
    @endif
        
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="/">Moguri</a>
    </nav>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        
        @yield("test")

        <span>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </span>
        
    </nav>
</header>