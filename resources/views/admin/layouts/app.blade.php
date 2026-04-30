<!DOCTYPE html>
<html lang="id">
<head>
    <base href="{{ asset('') }}">
    <title>@yield('title', 'Admin') – Sistem Jejaring Puskesmas Tebet</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/logosejati2.png') }}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet"/>
    @stack('styles')
</head>
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

<div class="d-flex flex-column flex-root">
<div class="page d-flex flex-row flex-column-fluid">

    {{-- ── SIDEBAR ── --}}
    <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true"
         data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
         data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
         data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">

        {{-- Logo --}}
        <div class="aside-logo flex-column-auto" id="kt_aside_logo">
            <a href="{{ route('admin.fasyankes.index') }}">
                <img alt="Logo" src="{{ asset('assets/media/logos/logosejatiputih.png') }}" class="h-40px logo"/>
            </a>
            <div id="kt_aside_toggle"
                 class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
                 data-kt-toggle="true" data-kt-toggle-state="active"
                 data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                <span class="svg-icon svg-icon-1 rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black"/>
                        <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black"/>
                    </svg>
                </span>
            </div>
        </div>

        {{-- Menu --}}
        <div class="aside-menu flex-column-fluid">
            <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper"
                 data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                 data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                 data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                <div id="kt_aside_menu" class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-300 fw-bold"
                     data-kt-menu="true">

                    <div class="menu-item">
                        <div class="menu-content pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">Menu Utama</span>
                        </div>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.fasyankes.*') ? 'active' : '' }}"
                           href="{{ route('admin.fasyankes.index') }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z" fill="black"/>
                                        <path opacity="0.3" d="M10 8V20H14V8H10ZM10 4H4C3.4 4 3 4.4 3 5V7C3 7.6 3.4 8 4 8H10V4ZM14 4V8H20C20.6 8 21 7.6 21 7V5C21 4.4 20.6 4 20 4H14Z" fill="black"/>
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Daftar Fasyankes</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- Footer sidebar --}}
        <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-custom btn-primary w-100">
                    <span class="svg-icon btn-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="4" y="11" width="12" height="2" rx="1" fill="black"/>
                            <path d="M5.86875 11.6927L7.62435 10.2297C8.09457 9.83785 8.12683 9.12683 7.69401 8.69401C7.28Child 8.28129 6.63701 8.28129 6.21875 8.69401L3.37436 11.2929C2.98383 11.6834 2.98383 12.3166 3.37436 12.7071L6.21875 15.306C6.63701 15.7187 7.28129 15.7187 7.69401 15.306C8.12683 14.8732 8.09457 14.1621 7.62435 13.7703L5.86875 12.3073C5.67382 12.1474 5.67382 11.8526 5.86875 11.6927Z" fill="black"/>
                            <path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6V5C10 4.44772 9.55228 4 9 4H5C3.34315 4 2 5.34315 2 7V17C2 18.6569 3.34315 20 5 20H9C9.55228 20 10 19.5523 10 19V18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19H5C4.44772 19 4 18.5523 4 18V7C4 6.44772 4.44772 6 5 6H8Z" fill="black"/>
                            <path opacity="0.3" d="M12 6.5C12 6.5 12 7.5 12.5 8C13 8.5 14 8.5 14 8.5H20C20.5523 8.5 21 8.94772 21 9.5V14.5C21 15.0523 20.5523 15.5 20 15.5H14C14 15.5 13 15.5 12.5 16C12 16.5 12 17.5 12 17.5V6.5Z" fill="black"/>
                        </svg>
                    </span>
                    <span class="btn-label">Logout</span>
                </button>
            </form>
        </div>
    </div>
    {{-- END SIDEBAR --}}

    <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

        {{-- ── HEADER ── --}}
        <div id="kt_header" class="header align-items-stretch">
            <div class="container-fluid d-flex align-items-stretch justify-content-between">
                <div class="d-flex align-items-center d-lg-none ms-n3 me-1">
                    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                         id="kt_aside_mobile_toggle">
                        <span class="svg-icon svg-icon-2x mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black"/>
                                <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                    <a href="{{ route('admin.fasyankes.index') }}" class="d-lg-none">
                        <img alt="Logo" src="{{ asset('assets/media/logos/logo-1.svg') }}" class="h-30px"/>
                    </a>
                </div>
                <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                    <div class="d-flex align-items-center" id="kt_header_nav">
                        <div class="d-flex align-items-center">
                            <span class="text-muted fw-bold fs-7 me-2">Panel Admin</span>
                            <span class="badge badge-light-primary fw-bolder fs-8">Puskesmas Tebet</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-stretch flex-shrink-0">
                        <div class="d-flex align-items-center ms-1 ms-lg-3">
                            <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                                 data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                 data-kt-menu-placement="bottom-end">
                                <div class="symbol symbol-35px symbol-circle">
                                    <span class="symbol-label bg-light-primary text-primary fw-bolder fs-6">
                                        {{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                 data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <div class="menu-content d-flex align-items-center px-3">
                                        <div class="symbol symbol-50px me-5 symbol-circle">
                                            <span class="symbol-label bg-light-primary text-primary fw-bolder fs-5">
                                                {{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="fw-bolder d-flex align-items-center fs-5">
                                                {{ Auth::guard('admin')->user()->name }}
                                            </div>
                                            <span class="fw-bold text-muted fs-7">
                                                {{ Auth::guard('admin')->user()->jabatan ?? 'Admin' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator my-2"></div>
                                <div class="menu-item px-5">
                                    <form method="POST" action="{{ route('admin.logout') }}">
                                        @csrf
                                        <button type="submit" class="menu-link px-5 border-0 bg-transparent w-100 text-start">
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END HEADER --}}

        {{-- Toolbar --}}
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">
                        @yield('page_title', 'Dashboard')
                    </h1>
                    @hasSection('breadcrumb')
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.fasyankes.index') }}" class="text-muted text-hover-primary">Admin</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-300 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-dark">@yield('breadcrumb')</li>
                    </ul>
                    @endif
                </div>
                <div class="d-flex align-items-center py-1"></div>
            </div>
        </div>
        
        {{-- ── CONTENT ── --}}
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <div id="kt_content_container" class="container-fluid">

                @if(session('success'))
                <div class="alert alert-success d-flex align-items-center p-5 mb-6">
                    <i class="fas fa-check-circle fs-2 text-success me-4"></i>
                    <div class="d-flex flex-column">{{ session('success') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center p-5 mb-6">
                    <i class="fas fa-exclamation-circle fs-2 text-danger me-4"></i>
                    <div class="d-flex flex-column">{{ session('error') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @yield('content')
            </div>
        </div>
        {{-- END CONTENT --}}

        <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
            <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                <div class="text-dark order-2 order-md-1">
                    <span class="text-muted fw-bold me-1">{{ date('Y') }}©</span>
                    <span class="text-gray-800">Puskesmas Tebet – Panel Admin Sistem Jejaring</span>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<script>var hostUrl = "{{ asset('assets/') }}";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script>
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
</script>
@stack('scripts')
</body>
</html>