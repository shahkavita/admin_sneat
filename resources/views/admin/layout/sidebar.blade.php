@php
    $currentRouteName = \Route::currentRouteName();
@endphp

<style>
    img {
        vertical-align: middle;

        width: 38%;
    }
</style>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/images/company_logo.png') }}" alt="Company Logo">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="{{ $currentRouteName == 'dashboard' ? 'menu-item active' : 'menu-item' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Page 1">Dashboard</div>
            </a>
        </li>
        <li class="{{ $currentRouteName == 'employee.index' ? 'menu-item active' : 'menu-item' }}">
            <a href="{{ route('employee.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Page 2">Employee</div>
            </a>
        </li>
         <li class="{{ request()->routeIs('admin.product.category','product') ? 'menu-item active' : 'menu-item' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Product</div>
            </a>
            <ul class="menu-sub">
                <li class="{{ $currentRouteName == 'admin.product.category' ? 'menu-item active' : 'menu-item' }}">
                    <a href="{{ route('admin.product.category') }}" class="menu-link">
                        <div data-i18n="Content nav + Sidebar">Category</div>
                    </a>
                </li>

                <li class="{{ $currentRouteName == 'product' ? 'menu-item active' : 'menu-item' }}">
                    <a href="{{route('product')}}" class="menu-link">
                        <div data-i18n="Fluid">Product</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="{{ $currentRouteName == 'team.index' ? 'menu-item active' : 'menu-item' }}">
            <a href="{{ route('team.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Page 2">Team</div>
            </a>
        </li>
    </ul>
</aside>
