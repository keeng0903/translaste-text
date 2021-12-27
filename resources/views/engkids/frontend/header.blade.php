<input id="page-nav-toggle" class="main-navigation-toggle" type="checkbox" />
<label for="page-nav-toggle">
    <svg class="icon--menu-toggle" viewBox="0 0 60 30">
        <g class="icon-group">
            <g class="icon--menu">
                <path d="M 6 0 L 54 0" />
                <path d="M 6 15 L 54 15" />
                <path d="M 6 30 L 54 30" />
            </g>
            <g class="icon--close">
                <path d="M 15 0 L 45 30" />
                <path d="M 15 30 L 45 0" />
            </g>
        </g>
    </svg>
</label>

<nav class="main-navigation">
    <ul>
        <li><a href="{{route('home')}}">Trang Chủ</a></li>
        @if(!empty(Session()->get('user')))
            <li><a href="{{route('user.logout')}}">Đăng Xuất</a></li>
        @else
            <li><a href="{{route('user.login')}}">Đăng Nhập</a></li>
        @endif
        <li><a href="{{route('user.history')}}">Lịch Sử</a></li>
        <li><a href="{{route('home.camera')}}">Camera</a></li>
        <li><a href="{{route('admin.login')}}">Login Admin</a></li>
    </ul>
</nav>
{{--<nav class="cd-stretchy-nav">--}}
{{--    <a class="cd-nav-trigger" href="#0">--}}
{{--        <span aria-hidden="true"></span>--}}
{{--    </a>--}}

{{--    <ul id="ul-header">--}}
{{--        <li><a href="{{route('home')}}" id="text-color-menu" class="active menu-top"><span>Trang Chủ</span></a></li>--}}
{{--        @if(!empty(Session()->get('user')))--}}
{{--        <li><a href="{{route('user.logout')}}" id="text-color-menu"><span></span>Đăng Xuất</a></li>--}}
{{--        @else--}}
{{--        <li><a href="{{route('user.login')}}" id="text-color-menu"><span></span>Đăng Nhập</a></li>--}}
{{--        @endif--}}
{{--        <li><a href="{{route('user.history')}}" id="text-color-menu" ><span>Lịch Sử</span></a></li>--}}
{{--        <li><a href="{{route('home.camera')}}" id="text-color-menu"><span>Camera</span></a></li>--}}
{{--        <li><a href="{{route('admin.login')}}" id="text-color-menu" class="menu-bottom"><span>Login Admin</span></a></li>--}}
{{--    </ul>--}}

{{--    <span aria-hidden="true" class="stretchy-nav-bg"></span>--}}
{{--</nav>--}}

