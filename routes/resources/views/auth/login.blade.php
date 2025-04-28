@extends('layouts.app')

@section('content')
    <style>
        .login {
            background-image: url('{{ asset('admin/img/pusbag.png') }}');
            background-size: 80%;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>

    <div class="container login">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"
                                style="background-image: url('{{ asset('admin/img/logopus.png') }}'); background-size: 50%; background-position: center; background-repeat: no-repeat;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ __('Login') }}</h1>
                                    </div>

                                    @if ($errors->any())
                                        <script>
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                                            });
                                        </script>
                                    @endif

                                    @if (session('error'))
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Login Gagal',
                                                    text: '{{ session('error') }}',
                                                });
                                            });
                                        </script>
                                    @endif

                                    <form method="POST" action="{{ route('login') }}" class="user">
                                        @csrf

                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email"
                                                placeholder="{{ __('Alamat Email') }}" value="{{ old('email') }}" required
                                                autofocus>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                placeholder="{{ __('Password') }}" required id="password">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="show-password">
                                                <label class="custom-control-label"
                                                    for="show-password">{{ __('Show Password') }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JavaScript to toggle password visibility -->
    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            var passwordField = document.getElementById('password');
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
@endsection
