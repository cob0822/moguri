<ul class="sidenav">
    <li class="menu">MENU</li>
	<li><a class="active" href="/">MAP</a></li>
	<li>{!! link_to_route("ranking", "ランキング") !!}</li>
		@if(Auth::check())
			<li><a>MYページ</a></li>
			<li>{!! link_to_route("mypost", "過去の投稿") !!}</li>
			<li>{!! link_to_route("favorites", "お気に入りポイント", ["id" => Auth::id()]) !!}</li>
			<li>{!! link_to_route("information", "ユーザー情報編集", ["id" => Auth::id()]) !!}</li>
		@endif
	<li>{!! link_to_route("post", "ポイントを投稿する") !!}</li>
	<li>{!! link_to_route("search", "ポイントを探す") !!}</li>
	<li>{!! link_to_route("search", "クジラが見たい") !!}</li>
	<li>{!! link_to_route("search", "沈没船が見たい") !!}</li>
	<li>{!! link_to_route("search", "海底遺跡が見たい") !!}</li>
	<li>{!! link_to_route("search", "洞窟を探検したい") !!}</li>
	<li>{!! link_to_route("inquiry", "お問い合わせ") !!}</li>
</ul>