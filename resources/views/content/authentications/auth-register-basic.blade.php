@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection


@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ url('/') }}" class="app-brand-link">
                                <img src="{{ asset('assets/img/logo/LOGOIF.png') }}" width="25" alt="">
                                <span class="app-brand-text demo menu-text fw-bold ms-2">Informatika</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Selamat Datang di Laboratorium Informatika</h4>
                        <p class="mb-4">Silahkan untuk daftar terlebih dahulu.</p>

                        <form class="mb-3" action="/register" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Masukan Nama Lengkap" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">NRP</label>
                                <input type="text" class="form-control" id="username" name="nrp"
                                    placeholder="Masukan NRP">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Masukan email Itenas">
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Masukan password" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger d-grid w-100">
                                Sign up
                            </button>
                        </form>

                        <p class="text-center">
                            <span>Sudah memiliki akun?</span>
                            <a href="{{ url('auth/login-basic') }}">
                                <span>Login</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>
@endsection
