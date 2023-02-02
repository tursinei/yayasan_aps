<title>@yield('title') | KULIA @php
    echo date('Y');
@endphp</title>
<meta name="author" content="Velly Coderz">
<meta name="corporation" content="Geomedia Sinergi">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
{{-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"> --}}
<link href="{{ asset('js/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('js/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('js/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('js/plugins/uniform/css/uniform.default.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('js/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="{{ asset('css/components-rounded.css') }}" id="style_components" rel="stylesheet" type="text/css">
<link href="{{ asset('css/plugins.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/layout/layout.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/layout/themes/grey.css') }}" rel="stylesheet" type="text/css" id="style_color">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<script src="{{ asset('js/pace.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/flash.css') }}">
@stack('css')
