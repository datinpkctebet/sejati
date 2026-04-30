<!DOCTYPE html>
<html lang="id">
<head>
    <base href="{{ asset('') }}">
    <title>Sistem Jejaring – Puskesmas Tebet</title>
    <meta name="description" content="Sistem Jejaring Puskesmas Tebet – Pengajuan Kerja Sama Fasyankes" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/logosejati2.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @stack('styles')
</head>
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

            {{-- HEADER --}}
            <div id="kt_header" class="header align-items-stretch">
                <div class="container-xxl d-flex align-items-stretch justify-content-between">
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
                        <a href="{{ route('dashboard') }}">
                            <img alt="Logo" src="{{ asset('assets/media/logos/logotebethitam.png') }}" class="h-20px h-lg-40px me-5" />
                            <img alt="Logo" src="{{ asset('assets/media/logos/logosejati1.png') }}" class="h-20px h-lg-40px" />
                        </a>
                    </div>
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                        <div class="d-flex align-items-stretch" id="kt_header_nav">
                            <!-- <div class="header-menu align-items-stretch"
                                 data-kt-drawer="true" data-kt-drawer-name="header-menu"
                                 data-kt-drawer-activate="{default: true, lg: false}"
                                 data-kt-drawer-overlay="true"
                                 data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                                 data-kt-drawer-direction="end"
                                 data-kt-drawer-toggle="#kt_header_menu_mobile_toggle"
                                 data-kt-swapper="true" data-kt-swapper-mode="prepend"
                                 data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                                <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                                     id="#kt_header_menu" data-kt-menu="true">
                                    <div class="menu-item me-lg-1">
                                        <a class="menu-link py-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                           href="{{ route('dashboard') }}">
                                            <span class="menu-title">Dashboard</span>
                                        </a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="d-flex align-items-center flex-shrink-0">
                            <!-- <a href="{{ route('dashboard') }}">
                                <img alt="Logo" src="{{ asset('assets/media/logos/logosejati1.png') }}" class="h-20px h-lg-40px" />
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
            {{-- END HEADER --}}

            {{-- CONTENT --}}
            <div class="content d-flex flex-column flex-column-fluid mt-10" id="kt_content">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        @yield('content')
                    </div>
                </div>
            </div>
            {{-- END CONTENT --}}

            {{-- FOOTER --}}
            <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-bold me-1">{{ date('Y') }}©</span>
                        <span class="text-gray-800">Puskesmas Tebet – Sistem Jejaring Fasyankes</span>
                    </div>
                </div>
            </div>
            {{-- END FOOTER --}}

        </div>
    </div>
</div>

{{-- Modals --}}
@include('modals.jenis-pengajuan')
@include('modals.alur-pengajuan')
@include('modals.form-pengajuan-baru')
@include('modals.form-pengajuan-perpanjangan')
@include('modals.sukses-tiket')
@include('modals.tracking-result')

{{-- Scroll Top --}}
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <span class="svg-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black"/>
            <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black"/>
        </svg>
    </span>
</div>

<script>var hostUrl = "{{ asset('assets/') }}";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
@stack('scripts')
</body>
</html>