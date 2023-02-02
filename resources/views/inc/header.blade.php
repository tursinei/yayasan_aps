{{--<div class="page-header-top">
    <div class="container-fluid">
        <!-- BEGIN LOGO -->
        <div class="page-logo" style="width:450px; height:90px;">
            <!-- a href="index.html"><img style='width:140px' src="{{ asset('css/img/logo-default.png') }}" alt="logo"
                    class="logo-default"></a -->

            <div class="header-logo" style="display: flex;justify-content: space-evenly;align-items: center;">
                <div style="display: inline-block;width: 60px;margin: 10px 0;">
                    <img src="{{ asset('img/batukota_logo.png') }}" alt="" style="width: 100%;">
                </div>
                <div style="display: inline-block;margin-left: 15px;">
                    <span class="inline-block" style="text-transform: uppercase;font-size: 15px;font-weight: bold;">PEMERINTAH KOTA BATU</span> <br>
                    <span class="inline-block" style="text-transform: uppercase;font-size: 12px;font-weight: bold;">BAGIAN PEMERINTAHAN SEKRETARIAT DAERAH</span> <br>
                    <span class="inline-block" style="text-transform: ;font-size: 12px;font-weight: bold;">E - LKPJ v.1</span>
                    <small class="inline-block" style="text-transform: uppercase;font-size: 10px;">Sistem Informasi Laporan Keterangan Pertanggungjawaban</small>
                </div>
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler"></a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="droddown dropdown-separator">
                    <span class="separator"></span>
                </li>

                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown dropdown-user dropdown-dark">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                        data-close-others="true">
                        <img alt="" class="img-circle" src="../../assets/admin/layout3/img/avatar9.jpg">
                        <span class="username username-hide-mobile">{{ Auth::user()->opd->nama ?? 'Admin' }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="javascript:void(0)" id="btn-change-password"><i class="icon-user"></i> Ubah Password </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" id="btn-logout"><i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
</div>--}}

<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="{{ route('dashboard') }}">
			 <img src="{{ asset('img/logo_head.png') }}" alt="logo" style="height: 40px;margin-top: 5px;"  class="logo-default">
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
					<img alt="" class="img-circle" src="../../assets/admin/layout/img/avatar3_small.jpg">
					<span class="username username-hide-on-mobile">
					{{ Auth::user()->name }}</span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="#" data-id="{{ Auth::user()->id }}" id="header-form-profil">
							<i class="icon-users"></i> Profile</a>
						</li>
						<li>
							<a href="{{ route('logout') }}">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="{{ route('logout') }}" class="dropdown-toggle" title="logout">
					<i class="icon-logout"></i>
					</a>
				</li>
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
