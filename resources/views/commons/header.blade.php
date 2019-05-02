<header class="mb-4">
    
        <!-- 以下のdivコードは　https://teratail.com/questions/148276　でググった-->
        <div class="fixed-top pt-2 pr-3" style="left:initial;">
            {!! link_to_route("signup.get", "ユーザー登録", [], ["class" => "btn btn-warning"]) !!}
            {!! link_to_route("login", "ログイン", [], ["class" => "btn btn-warning"]) !!}
        </div>
        
            <nav class="navbar navbar-expand-sm navbar-light bg-light">
                <a class="navbar-brand" href="/">Moguri</a>
        
        

    </nav>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        
        @yield("test")
        
    </nav>
</header>