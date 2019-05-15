<header class="mb-4">
    
    @if(Auth::check())
        <div class="fixed-top pt-2 pr-3" style="left:initial;">
            {!! link_to_route("logout.get", "ログアウト", [], ["class" => "btn btn-warning"]) !!}
            <span class="pl-3 pr-2">{{Auth::user()->name}}</span>
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
        <!--
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav">
                <li class="menu">MENU</li>
            	<li class="nav-item active"><a href="/" class="nav-link">MAP</a></li>
            	<li class="nav-item">{!! link_to_route("ranking", "ランキング") !!}</li>
            		@if(Auth::check())
            			<li><a>MYページ</a></li>
            			<li class="nav-item">{!! link_to_route("mypost", "過去の投稿") !!}</li>
            			<li class="nav-item">{!! link_to_route("favorites", "お気に入りポイント", ["id" => Auth::id()]) !!}</li>
            			<li class="nav-item">{!! link_to_route("information", "ユーザー情報編集", ["id" => Auth::id()]) !!}</li>
            		@endif
            	<li class="nav-item">{!! link_to_route("post", "ポイントを投稿する") !!}</li>
            	<li class="nav-item">{!! link_to_route("search", "ポイントを探す") !!}</li>
            	<li class="nav-item">{!! link_to_route("search", "クジラが見たい") !!}</li>
            	<li class="nav-item">{!! link_to_route("search", "沈没船が見たい") !!}</li>
            	<li class="nav-item">{!! link_to_route("search", "海底遺跡が見たい") !!}</li>
            	<li class="nav-item">{!! link_to_route("search", "洞窟を探検したい") !!}</li>
    	        <li class="nav-item">{!! link_to_route("inquiry", "お問い合わせ") !!}</li>
            </ul>
        </div>
        -->
        
        
	
	
    </nav>
</header>