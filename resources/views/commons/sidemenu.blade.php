<ul class="sidenav">
    <li class="menu">MENU</li>
	<li>{!! link_to_route("top", "MAP") !!}</li>
	<li>{!! link_to_route("ranking", "ランキング") !!}</li>
		
	<li>{!! link_to_route("post", "ポイントを投稿する") !!}</li>
	<li>{!! link_to_route("search", "ポイントを探す") !!}</li>
	<li>{!! link_to_route("search.this", "クジラが見たい", ["init" => "クジラ"]) !!}</li>
	<li>{!! link_to_route("search.this", "沈没船が見たい", ["init" => "沈没船"]) !!}</li>
	<li>{!! link_to_route("search.this", "海底遺跡が見たい", ["init" => "海底遺跡"]) !!}</li>
	<li>{!! link_to_route("search.this", "洞窟を探検したい", ["init" => "洞窟"]) !!}</li>
	@if(Auth::check())
			<li>{!! link_to_route("mypost", "（MY）過去の投稿") !!}</li>
			<li>{!! link_to_route("favorites", "（MY）お気に入りポイント", ["id" => Auth::id()]) !!}</li>
			<li>{!! link_to_route("information", "（MY）ユーザー情報編集", ["id" => Auth::id()]) !!}</li>
		@endif
	<li>{!! link_to_route("inquiry", "お問い合わせ") !!}</li>
</ul>