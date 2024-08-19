@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- Register -->
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
                        <p class="mb-4">Silahkan untuk login menggunakan user SIKAD</p>

                        <form id="formAuthentication" class="mb-3" action="/login" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">NRP / NODOS</label>
                                <input type="text" class="form-control" id="email" name="identifier"
                                    placeholder="Masukan Email atau NRP" autofocus>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me">
                                    <label class="form-check-label" for="remember-me">
                                        Remember Me
                                    </label>
                                </div>
                            </div> --}}
                            <div class="mb-3">
                                <button class="btn btn-danger d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>Belum punya akun?</span>
                            <a href="{{ url('auth/register-basic') }}">
                                <span>Daftar disini</span>
                            </a>
                        </p>
                        <p class="text-center">
                            <a href="{{ url('auth/forgot-password-basic') }}">
                                <span>Lupa Password</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
    </div>
@endsection
