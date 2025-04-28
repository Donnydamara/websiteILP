@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Tambah Data Tindakan Lanjut Kunjungan Rumah') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tindak_lanjut_kunjungan.store') }}" method="post" id="modal-save-form">
                @csrf
                <div class="form-group">
                    <label for="status">Status Tindak Lanjut</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" required>
                        <option value="">Pilih</option>
                        <option value="Ya" {{ old('status') === 'Ya' ? 'selected' : '' }}>Ya
                        </option>

                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="posyandu">Posyandu</label>
                            <input type="text" class="form-control @error('posyandu') is-invalid @enderror"
                                name="posyandu" id="posyandu" value="{{ old('posyandu') }}" required readonly>
                            @error('posyandu')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                    id="nik" value="{{ old('nik') }}" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="btnCekData">Cek
                                        Data</button>
                                </div>
                            </div>
                            @error('nik')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" value="{{ old('nama') }}" required readonly>
                            @error('nama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="waktu">Waktu</label>
                            <input type="datetime-local" class="form-control @error('waktu') is-invalid @enderror"
                                name="waktu" id="waktu" value="{{ old('waktu') }}" required>
                            @error('waktu')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}" required readonly>
                            @error('tgl_lahir')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="2"
                                required readonly>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_telepon">No Telepon</label>
                            <input type="number" class="form-control @error('no_telepon') is-invalid @enderror"
                                name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" required>
                            @error('no_telepon')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="masalah_kesehatan_yang_ditemukan">Masalah Kesehatan yang Ditemukan</label>
                            <textarea class="form-control @error('masalah_kesehatan_yang_ditemukan') is-invalid @enderror"
                                name="masalah_kesehatan_yang_ditemukan" id="masalah_kesehatan_yang_ditemukan" rows="2" required>{{ old('masalah_kesehatan_yang_ditemukan') }}</textarea>
                            @error('masalah_kesehatan_yang_ditemukan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tindak_lanjut">Tindak Lanjut</label>
                    <textarea class="form-control @error('tindak_lanjut') is-invalid @enderror" name="tindak_lanjut" id="tindak_lanjut"
                        rows="2" required>{{ old('tindak_lanjut') }}</textarea>
                    @error('tindak_lanjut')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edukasi">Edukasi</label>
                            <select class="form-control @error('edukasi') is-invalid @enderror" name="edukasi"
                                id="edukasi" required>
                                <option value="">Pilih</option>
                                <option value="Ya" {{ old('edukasi') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('edukasi') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                            @error('edukasi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lapor_nakes">Lapor Nakes</label>
                            <select class="form-control @error('lapor_nakes') is-invalid @enderror" name="lapor_nakes"
                                id="lapor_nakes" required>
                                <option value="">Pilih</option>
                                <option value="Ya" {{ old('lapor_nakes') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('lapor_nakes') == 'Tidak' ? 'selected' : '' }}>Tidak
                                </option>
                            </select>
                            @error('lapor_nakes')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" onclick="showLoading()">Simpan</button>
                <a href="{{ route('tindak_lanjut_kunjungan.index') }}" class="btn btn-default">Kembali</a>
            </form>
        </div>
    </div>
    <!-- End of Main Content -->
@endsection

@section('scripts')
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#btnCekData').click(function() {
                var nik = $('#nik').val();

                // Menampilkan SweetAlert2 loading
                Swal.fire({
                    title: 'Memeriksa...',
                    text: 'Harap tunggu sebentar.',
                    imageUrl: 'https://media.tenor.com/y6-Oq1X_9NcAAAAC/loading-loading-gif.gif',
                    imageWidth: 100,
                    imageHeight: 100,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                // Kirim permintaan AJAX ke backend untuk memeriksa NIK
                $.ajax({
                    url: '{{ route('check-nik') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nik: nik
                    },
                    success: function(response) {
                        Swal.close();
                        if (response.status === 'success') {
                            // Isi field nama dan tgl_lahir jika NIK ditemukan
                            $('#nama').val(response.data.nama);
                            $('#tgl_lahir').val(response.data.tgl_lahir);
                            $('#alamat').val(response.data.alamat);
                            $('#posyandu').val(response.data.posyandu);
                            Swal.fire({
                                icon: 'success',
                                title: 'NIK valid!',
                                text: response.message
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'NIK tidak valid!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat memeriksa NIK.'
                        });
                    }
                });
            });
        });


        function setAction(action) {
            // Show SweetAlert2 loading animation
            Swal.fire({
                title: 'Saving...',
                text: 'Please wait while we save your data.',
                imageUrl: 'https://media.tenor.com/y6-Oq1X_9NcAAAAC/loading-loading-gif.gif',
                imageWidth: 100,
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });

            // Submit the form after showing the loading animation
            document.getElementById('form-create').submit();
        }
    </script>
@endsection
