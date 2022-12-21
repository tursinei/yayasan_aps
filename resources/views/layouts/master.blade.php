<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('inc.taghead')
</head>

<body
    class="page-header-fixed page-sidebar-closed-hide-logo page-header-fixed-mobile page-footer-fixed1">

    <div class="page-header navbar navbar-fixed-top">
        @include('inc.header')
    </div>
    <div class="clearfix"></div>
    <div class="page-container">
        @include('inc.navigasi')

        @include('inc.content')
    </div>

    @include('inc.footer', ['isLogin' => false])
</body>

</html>
