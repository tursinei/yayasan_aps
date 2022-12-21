<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-title">@yield('title','')
            <small>@yield('subTitle','')</small>
        </div>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="{{ route('dashboard') }}">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
            </ul>
        </div>
        @yield('content')
    </div>
</div>
