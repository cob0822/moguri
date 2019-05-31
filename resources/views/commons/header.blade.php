<header id="header" class="mb-4">
    
    @if(Auth::check())
        <div class="fixed-top pt-2 pr-3" style="left:initial;">
            <!--ここにアイコンを出す -->
            @if(isset(\Auth::user()->icon))
                <img src="{{\Auth::user()->icon}}" width="60" height="45">
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

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar" aria-controls="nav-bar" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
        
        
            <!-- メニュー項目 -->
            <div class="collapse navbar-collapse" id="nav-bar">
                <ul class="navbar-nav phone_area">
                    @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" style="color:#FFFFFF;">MYページ</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item">{!! link_to_route("mypost", "　過去の投稿", [], ["style" => "color:#000000;"]) !!}</a>
                            <a class="dropdown-item">{!! link_to_route("favorites", "　お気に入りポイント", ["id" => Auth::id()], ["style" => "color:#000000;"]) !!}</a>
                            <a class="dropdown-item">{!! link_to_route("information", "　ユーザー情報編集", ["id" => Auth::id()], ["style" => "color:#000000;"]) !!}</a>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item active"><a class="nav-link">{!! link_to_route("top", "MAP", [], ["style" => "color:#FFFFFF;"]) !!}</a></li>
                    <li class="nav-item"><a class="nav-link">{!! link_to_route("ranking", "ランキング", [], ["style" => "color:#FFFFFF;"]) !!}</a></li>
                    <li class="nav-item"><a class="nav-link">{!! link_to_route("post", "ポイントを投稿する", [], ["style" => "color:#FFFFFF;"]) !!}</a></li>
                    <li class="nav-item"><a class="nav-link">{!! link_to_route("search", "ポイントを探す", [], ["style" => "color:#FFFFFF;"]) !!}</a></li>
                    <li class="nav-item"><a class="nav-link">{!! link_to_route("search.this", "クジラが見たい", ["init" => "クジラ"], ["style" => "color:#FFFFFF;"]) !!}</a></li>
                    <li class="nav-item"><a class="nav-link">{!! link_to_route("search.this", "沈没船が見たい", ["init" => "沈没船"], ["style" => "color:#FFFFFF;"]) !!}</a></li>
                    <li class="nav-item"><a class="nav-link">{!! link_to_route("search.this", "海底遺跡が見たい", ["init" => "海底遺跡"], ["style" => "color:#FFFFFF;"]) !!}</a></li>
                    <li class="nav-item"><a class="nav-link">{!! link_to_route("search.this", "洞窟を探検したい", ["init" => "洞窟"], ["style" => "color:#FFFFFF;"]) !!}</a></li>
                    <li class="nav-item"><a class="nav-link">{!! link_to_route("inquiry", "お問い合わせ", [], ["style" => "color:#FFFFFF;"]) !!}</a></li>
                </ul>
            </div>
    </nav>
</header>