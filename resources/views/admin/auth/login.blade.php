<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Admin – Sistem Jejaring Puskesmas Tebet</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/logosejati2.png') }}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet"/>
</head>
<body id="kt_body" class="bg-body" style="background-image: url('{{ asset('assets/media/patterns/header-bg.jpg') }}')">

<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">

        {{-- Sisi kiri --}}
        <div class="d-flex flex-lg-row-fluid">
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                <img class="mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                     src="{{ asset('assets/media/auth/agency.png') }}" alt=""/>
                <h1 class="text-gray-800 fs-2qx fw-bolder text-center mb-7">
                    Sistem Jejaring Fasyankes
                </h1>
                <div class="text-gray-600 fs-base text-center fw-semibold">
                    Platform pengajuan dan tracking kerja sama<br/>
                    antara Fasyankes dan <strong>Puskesmas Tebet</strong>
                </div>
            </div>
        </div>

        {{-- Sisi kanan: form --}}
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
            <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">

                    <form class="form w-100" method="POST" action="{{ route('admin.login.post') }}">
                        @csrf

                        <div class="text-center mb-11">
                            <h1 class="text-dark fw-bolder mb-3">Login Admin</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Panel Administrasi Puskesmas Tebet</div>
                        </div>

                        @if(session('error'))
                        <div class="alert alert-danger d-flex align-items-center p-5 mb-8">
                            <i class="fas fa-exclamation-circle fs-2 text-danger me-3"></i>
                            {{ session('error') }}
                        </div>
                        @endif

                        {{-- Email --}}
                        <div class="fv-row mb-8">
                            <input type="email" name="email" placeholder="Email Admin"
                                   value="{{ old('email') }}"
                                   class="form-control bg-transparent @error('email') is-invalid @enderror"
                                   autocomplete="email" autofocus/>
                            @error('email')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="fv-row mb-3">
                            <input type="password" name="password" placeholder="Password"
                                   class="form-control bg-transparent @error('password') is-invalid @enderror"
                                   autocomplete="current-password"/>
                            @error('password')
                                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Remember --}}
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="remember" value="1"/>
                                <span class="form-check-label text-gray-700">Ingat Saya</span>
                            </label>
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Masuk</span>
                                <span class="indicator-progress">
                                    Mohon tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>

                        <div class="text-center text-muted fs-7">
                            Akses hanya untuk petugas resmi Puskesmas Tebet
                        </div>
                    </form>

                </div>

                <div class="d-flex flex-stack px-lg-10">
                    <div class="text-gray-500 fw-semibold fs-7 text-center w-100">
                        © {{ date('Y') }} Puskesmas Tebet – Sistem Jejaring
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>var hostUrl = "{{ asset('assets/') }}";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>
</html>