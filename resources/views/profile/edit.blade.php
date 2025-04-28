@extends('layouts.master')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit Profile') }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <!-- Foto Profil -->
                <div class="text-center mb-4">
                    <label for="profile_photo" class="d-block">Foto Profil</label>
                    <img src="{{ Auth::user()->profile_photo ? asset('uploads/profile_photos/' . Auth::user()->profile_photo) : asset('images/default-profile.png') }}"
                        class="rounded-circle mb-2" alt="Foto Profil" width="150" height="150">
                    <input type="file" class="form-control mt-2" id="profile_photo" name="profile_photo"
                        accept="image/*">
                    @error('profile_photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Nama -->
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="name">Nama Depan</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', Auth::user()->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="last_name">Nama Belakang</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                            name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}">
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Input Email -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', Auth::user()->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Input Password -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="current_password">Password Saat Ini</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                            id="current_password" name="current_password"
                            placeholder="Masukkan password saat ini jika ingin mengganti password">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="new_password">Password Baru</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                            id="new_password" name="new_password" placeholder="Opsional: Masukkan password baru">
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            placeholder="Opsional: Konfirmasi password baru">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Tombol Simpan -->
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit">Simpan Profil</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
            });
        @endif
    </script>
@endsection
