@php

function renderSubMenu($value, $currentUrl)
{
    $isActiveChildUrl = false;
    $isParentActive = false;
    $subMenu = '';
    foreach ($value as $key => $menu) {
        if (!in_array(Session::get('tipe_user'), $menu['akses'])) {
            continue;
        }

        $subSubMenu = '';
        $hasTitle = !empty($menu['title']) ? $menu['title'] : '';
        $hasSubTitle = !empty($menu['subTitle']) ? $menu['subTitle'] : '';
        $hasIcon = !empty($menu['icon']) ? '<i class="fa ' . $menu['icon'] . '"></i>' : '';

        $currentUrl = Request::route()->getName();
        $isActiveChildUrl = $currentUrl == $menu['url'];
        if ($isActiveChildUrl && !$isParentActive) {
            $isParentActive = true;
        }
        $active = $isActiveChildUrl ? 'active' : '';
        if (Route::has($menu['url'])) {
            $menu['url'] = route($menu['url']);
        } else {
            $menu['url'] = URL::to($menu['url']);
        }
        $subMenu .='<li class="' .$active . '"> <a class="iconfy" href="' .$menu['url']
                .'" title="' .$hasSubTitle .'" >' .$hasIcon .' ' .$hasTitle .'</a></li>';
    }
    return ['subMenu' => $subMenu, 'parentActive' => $isParentActive];
}

function renderMenu()
{
    $return = '';
    // $currentUrl = Request::path();
    $currentUrl = Request::route()->getName();
    $classStart = 'start';
    foreach (config('sidebar.menu') as $key => $menu) {
        if (!in_array(Session::get('tipe_user'), $menu['akses'])) {
            continue;
        }

        $isActive = $currentUrl == $menu['url'];
        // $menu['url'] = URL::to($menu['url']);
        if (Route::has($menu['url'])) {
            $menu['url'] = route($menu['url']);
        } else {
            $menu['url'] = URL::to($menu['url']);
        }
        // if (!in_array(Session::get('lkpj_tipe'), $menu['akses'])) {
        //     continue;
        // }

        $idMenu = 'navbar-' . str_replace(' ', '', $menu['title']);
        // $hasSub = !empty($menu['sub_menu']) ? 'menu-dropdown mega-menu-dropdown' : '';
        // $hasSubLink = !empty($menu['sub_menu']) ? 'data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" class="dropdown-toggle hover-initialized"' : '';
        $hasSubCaret = !empty($menu['sub_menu']) ? '<span class="arrow"></span>' : '';
        $hasIcon = !empty($menu['icon']) ? '<i class="fa ' . $menu['icon'] . '"></i>' : '';
        $hasTitle = !empty($menu['title']) ? '<span class="title">' . $menu['title'] . '</span>' : '';
        $hasSubTitle = !empty($menu['subTitle']) ? $menu['subTitle'] : '';

        $subMenu = '';
        $isParentActive = false;
        $show = '';
        if (!empty($menu['sub_menu'])) {
            $render = renderSubMenu($menu['sub_menu'], $currentUrl, $menu['title']);
            $isParentActive = $render['parentActive'];
            $show = $isParentActive ? 'active' : '';
            $subMenu .= '<ul class="sub-menu">';
            $subMenu .= $render['subMenu'];
            $subMenu .= '   </ul>';
            // $menu['url'] = '#' . $idMenu;
        }

        $activeText = '';
        $selectedSpan = '';
        if ($isActive) {
            $activeText     = 'active';
            $selectedSpan   = '<span class="selected"></span>';
        }
        $class  = [$activeText, $show, $classStart];
        array_filter($class);
        $return .=
            '<li class="' .implode(' ',$class) .'">
                <a title="' . $hasSubTitle .'" href="' .$menu['url'] . '">' .
                $hasIcon .' ' .$hasTitle . ' '.$selectedSpan .' '.$hasSubCaret .'</a>' .
                $subMenu .
            '</li>';
        $classStart = '';
    }
    return $return;
}
@endphp
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu"  data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            @php
                echo renderMenu();
            @endphp
        </ul>
    </div>
</div>
