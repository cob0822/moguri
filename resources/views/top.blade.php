@extends("layouts.app")

@section("content")
    
    @section("test")
        <div class="tipsbar">
            <span>
                {!! link_to_route("search", "目的から探す", [], ["class" => "btn btn-warning btn-sm"]) !!}
            </span>
            <span class="text-white small pl-2 pc_area">
                <見たい生き物やポイントから検索
            </span>
        </div>
    @endsection
    
    <div class="row">
        <div class="col-12 col-md-8">
            <!--グーグルマップ-->
            <div class="gmap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13753032.90016899!2d129.42427996777207!3d32.694712168537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f6!3m3!1m2!1s0x34674e0fd77f192f%3A0xf54275d47c665244!2z5pel5pys!5e0!3m2!1sja!2sjp!4v1556797602173!5m2!1sja!2sjp" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
        <aside class="col-md-4">
            @include("commons.sidemenu")
        </aside>
    </div>
@endsection
