<!DOCTYPE html>

<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="UTF-8">
    @section('title', 'Login || KULIA')
    @push('css')
        <link href="{{ asset('css/login-soft.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    @include('inc.taghead')


</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        {{-- <a href="index.html"> LKPJ </a> --}}
        <div class="header-logo" style="display: flex;justify-content: center;align-items: center;flex-direction: column;">
            <div style="display: inline-block;width: 120px;margin: 10px 0;">
                <img src="{{ asset('img/logo.png') }}" alt="" style="width: 100%;">
            </div>
            <h1 style="text-transform: uppercase;font-size: 22px;font-weight: bold; color:white;margin-top: 10px;">KULIA</h1> <br>
            <h1 style="text-transform: uppercase;font-size: 15px;font-weight: bold; color:white;margin-top: 0px;">Kumpulan Peduli Anak Yatim Dan Dhuafa</h1> <br>
            <p class="inline-block" style="text-transform: uppercase;font-size: 11px; color:white;">
                Kec. Ngoro, Kabupaten Mojokerto, Jawa Timur 61385
            </p>
        </div>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <div class="menu-toggler sidebar-toggler">
    </div>
    <!-- END SIDEBAR TOGGLER BUTTON -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <form class="login-form" action="{{ route('login') }}" method="POST">
            @csrf
            <h3 class="form-title text-center">LOGIN</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li><span>{{ $error }}</span></li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off"
                        placeholder="Username Or Email" name="email" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                        placeholder="Password" name="password" />
                </div>
            </div>
            <div class="form-actions">
                <label class="checkbox">
                    {{-- <input type="checkbox" name="remember" /> Remember me  --}}
                </label>
                <button type="submit" class="btn blue pull-right">
                    Login <i class="m-icon-swapright m-icon-white"></i>
                </button>
            </div>

            {{-- <div class="forget-password">
			<h4>Forgot your password ?</h4>
			<p>
				 no worries, click <a href="javascript:;" id="forget-password">
				here </a>
				to reset your password.
			</p>
		</div> --}}
        </form>
        <!-- END LOGIN FORM -->
        <!-- BEGIN FORGOT PASSWORD FORM -->
        {{-- <form class="forget-form" action="index.html" method="post">
		<h3>Forget Password ?</h3>
		<p>
			 Enter your e-mail address below to reset your password.
		</p>
		<div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" class="btn blue pull-right">
			Submit <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form> --}}
        <!-- END FORGOT PASSWORD FORM -->
    </div>
    <!-- END LOGIN -->
    <!-- BEGIN COPYRIGHT -->
    <div class="copyright">
        @php
            echo date('Y');
        @endphp &copy; KULIA
    </div>
    @push('js')
        <script src="{{ asset('js/login-soft.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>

        <script>
            jQuery(document).ready(function() {
                $.backstretch([
                    "{{ asset('css/img/bg/1.jpg') }}",
                    "{{ asset('css/img/bg/2.jpg') }}",
                    "{{ asset('css/img/bg/3.jpg') }}",
                    "{{ asset('css/img/bg/4.jpg') }}"
                ], {
                    fade: 1000,
                    duration: 8000
                });
            });
        </script>
    @endpush
    @include('inc.footer', ['isLogin' => 'true'])

    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>
