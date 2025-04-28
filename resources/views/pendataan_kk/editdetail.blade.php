@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Update Data Kartu Keluarga') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pendataan_kk.updatedetail', ['id' => $data->id]) }}" method="post" id="modal-save-form">

                <!-- Perubahan pada action -->
                @csrf
                @method('PUT') <!-- Perubahan pada method -->

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kk">Kartu Keluarga</label>
                            <input type="number" class="form-control @error('kk') is-invalid @enderror" name="kk"
                                id="kk" value="{{ old('kk') ?? $data->kk }}" required readonly>
                            @error('kk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" placeholder="nama" autocomplete="off"
                                value="{{ old('nama') ?? $data->nama }}" required>
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                id="nik" placeholder="NIK" autocomplete="off" value="{{ old('nik') ?? $data->nik }}"
                                required>
                            @error('nik')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                name="tgl_lahir" id="tgl_lahir" autocomplete="off"
                                value="{{ old('tgl_lahir') ?? $data->tgl_lahir }}" required>
                            @error('tgl_lahir')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender"
                                required>
                                <option value="">-- Select Gender --</option>
                                <option value="Laki-laki"
                                    {{ old('gender') ?? $data->gender == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan"
                                    {{ old('gender') ?? $data->gender == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hubungan_keluarga">Hubungan Keluarga</label>
                            <select class="form-control @error('hubungan_keluarga') is-invalid @enderror"
                                name="hubungan_keluarga" id="hubungan_keluarga" required>
                                <option value="">-- Pilih Hubungan Keluarga --</option>
                                <option value="Kepala Keluarga"
                                    {{ old('hubungan_keluarga') ?? $data->hubungan_keluarga == 'Kepala Keluarga' ? 'selected' : '' }}>
                                    Kepala Keluarga
                                </option>
                                <option value="Istri"
                                    {{ old('hubungan_keluarga') ?? $data->hubungan_keluarga == 'Istri' ? 'selected' : '' }}>
                                    Istri
                                </option>
                                <option value="Suami"
                                    {{ old('hubungan_keluarga') ?? $data->hubungan_keluarga == 'Suami' ? 'selected' : '' }}>
                                    Suami
                                </option>
                                <option value="Anak"
                                    {{ old('hubungan_keluarga') ?? $data->hubungan_keluarga == 'Anak' ? 'selected' : '' }}>
                                    Anak
                                </option>
                                <option value="Menantu"
                                    {{ old('hubungan_keluarga') ?? $data->hubungan_keluarga == 'Menantu' ? 'selected' : '' }}>
                                    Menantu
                                </option>
                                <option value="Cucu"
                                    {{ old('hubungan_keluarga') ?? $data->hubungan_keluarga == 'Cucu' ? 'selected' : '' }}>
                                    Cucu
                                </option>
                                <option value="Orang Tua"
                                    {{ old('hubungan_keluarga') ?? $data->hubungan_keluarga == 'Orang Tua' ? 'selected' : '' }}>
                                    Orang Tua
                                </option>
                                <option value="Famili Lain"
                                    {{ old('hubungan_keluarga') ?? $data->hubungan_keluarga == 'Famili Lain' ? 'selected' : '' }}>
                                    Famili Lain</option>
                                <option value="Pembantu Asisten Pekerja Lain"
                                    {{ old('hubungan_keluarga') ?? $data->hubungan_keluarga == 'Pembantu Asisten Pekerja Lain' ? 'selected' : '' }}>
                                    Pembantu/
                                    Asisten/ Pekerja Lain</option>
                                <option value="Lainnya"
                                    {{ old('hubungan_keluarga') ?? $data->hubungan_keluarga == 'Lainnya' ? 'selected' : '' }}>
                                    Lainnya
                                </option>
                            </select>
                            @error('hubungan_keluarga')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status_perkawinan">Status Perkawinan</label>
                            <select class="form-control @error('status_perkawinan') is-invalid @enderror"
                                name="status_perkawinan" id="status_perkawinan" required>
                                <option value="">-- Pilih Status Perkawinan --</option>
                                <option value="kawin"
                                    {{ old('status_perkawinan') ?? $data->status_perkawinan == 'kawin' ? 'selected' : '' }}>
                                    Kawin
                                </option>
                                <option value="belum_kawin"
                                    {{ old('status_perkawinan') ?? $data->status_perkawinan == 'belum_kawin' ? 'selected' : '' }}>
                                    Belum
                                    Kawin</option>
                                <option value="cerai_hidup"
                                    {{ old('status_perkawinan') ?? $data->status_perkawinan == 'cerai_hidup' ? 'selected' : '' }}>
                                    Cerai
                                    Hidup</option>
                                <option value="cerai_mati"
                                    {{ old('status_perkawinan') ?? $data->status_perkawinan == 'cerai_mati' ? 'selected' : '' }}>
                                    Cerai
                                    Mati</option>
                            </select>
                            @error('status_perkawinan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                            <select class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                                name="pendidikan_terakhir" id="pendidikan_terakhir" required>
                                <option value="">-- Pilih Pendidikan Terakhir --</option>
                                <option value="S1 / S2 / S3"
                                    {{ old('pendidikan_terakhir') ?? $data->pendidikan_terakhir == 'S1 / S2 / S3' ? 'selected' : '' }}>
                                    S1 / S2 /
                                    S3 (PT)</option>
                                <option value="D1 / D2 / D3"
                                    {{ old('pendidikan_terakhir') ?? $data->pendidikan_terakhir == 'D1 / D2 / D3' ? 'selected' : '' }}>
                                    D1 / D2 /
                                    D3</option>
                                <option value="SMA Atau Sederajat"
                                    {{ old('pendidikan_terakhir') ?? $data->pendidikan_terakhir == 'SMA Atau Sederajat' ? 'selected' : '' }}>
                                    SMA
                                    Atau
                                    Sederajat</option>
                                <option value="SMP Atau Sederajat"
                                    {{ old('pendidikan_terakhir') ?? $data->pendidikan_terakhir == 'SMP Atau Sederajat' ? 'selected' : '' }}>
                                    SMP
                                    Atau
                                    Sederajat</option>
                                <option value="SD Atau Sederajat"
                                    {{ old('pendidikan_terakhir') ?? $data->pendidikan_terakhir == 'SD Atau Sederajat' ? 'selected' : '' }}>
                                    SD Atau
                                    Sederajat
                                </option>
                                <option value="Tidak Pernah Sekolah"
                                    {{ old('pendidikan_terakhir') ?? $data->pendidikan_terakhir == 'Tidak Pernah Sekolah' ? 'selected' : '' }}>
                                    Tidak
                                    pernah
                                    sekolah</option>
                            </select>
                            @error('pendidikan_terakhir')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <select class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan"
                                id="pekerjaan" required>
                                <option value="">-- Pilih Pekerjaan --</option>
                                <option value="Tidak Bekerja"
                                    {{ old('pekerjaan') ?? $data->pekerjaan == 'Tidak Bekerja' ? 'selected' : '' }}>
                                    Tidak
                                    Bekerja</option>
                                <option value="Pelajar / Mahasiswa"
                                    {{ old('pekerjaan') ?? $data->pekerjaan == 'Pelajar / Mahasiswa' ? 'selected' : '' }}>
                                    Pelajar / Mahasiswa</option>
                                <option value="PNS / TNI-POLRI / BUMN / BUMD"
                                    {{ old('pekerjaan') ?? $data->pekerjaan == 'PNS / TNI-POLRI / BUMN / BUMD' ? 'selected' : '' }}>
                                    PNS / TNI-POLRI /
                                    BUMN /
                                    BUMD</option>
                                <option value="Pegawai Swasta"
                                    {{ old('pekerjaan') ?? $data->pekerjaan == 'Pegawai Swasta' ? 'selected' : '' }}>
                                    Pegawai Swasta</option>
                                <option value="Wiraswasta"
                                    {{ old('pekerjaan') ?? $data->pekerjaan == 'Wiraswasta' ? 'selected' : '' }}>
                                    Wiraswasta
                                </option>
                                <option value="Petani Nelayan"
                                    {{ old('pekerjaan') ?? $data->pekerjaan == 'Petani Nelayan' ? 'selected' : '' }}>Petani
                                    / Nelayan</option>
                                <option value="Lainnya"
                                    {{ old('pekerjaan') ?? $data->pekerjaan == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                            @error('pekerjaan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kelompok_sasaran">Kelompok Sasaran</label>
                            <select class="form-control @error('kelompok_sasaran') is-invalid @enderror"
                                name="kelompok_sasaran" id="kelompok_sasaran" required>
                                <option value="">-- Pilih Kelompok Sasaran --</option>
                                <option value="Ibu Hamil"
                                    {{ old('kelompok_sasaran') ?? $data->kelompok_sasaran == 'Ibu Hamil' ? 'selected' : '' }}>
                                    Ibu Hamil
                                </option>
                                <option value="Ibu Bersalin dan Lifas"
                                    {{ old('kelompok_sasaran') ?? $data->kelompok_sasaran == 'Ibu Bersalin dan Lifas' ? 'selected' : '' }}>
                                    Ibu
                                    Bersalin dan
                                    Lifas</option>
                                <option value="Bayi Balita (0 - 6 tahun)"
                                    {{ old('kelompok_sasaran') ?? $data->kelompok_sasaran == 'Bayi Balita (0 - 6 tahun)' ? 'selected' : '' }}>
                                    Bayi Balita (0 - 6 tahun)</option>
                                <option value="Bayi, Balita Dan Anak Usia Prasekolah (Usia >6 - 71 Bulan)"
                                    {{ old('kelompok_sasaran') ?? $data->kelompok_sasaran == 'Bayi, Balita Dan Anak Usia Prasekolah (Usia >6 - 71 Bulan)' ? 'selected' : '' }}>
                                    Bayi, Balita Dan Anak Usia Prasekolah (Usia >6 - 71 Bulan)</option>
                                <option value="Usia Sekolah dan Remaja (>6 - <18 tahun)"
                                    {{ old('kelompok_sasaran') ?? $data->kelompok_sasaran == 'Usia Sekolah dan Remaja (>6 - <18 tahun)' ? 'selected' : '' }}>
                                    Usia Sekolah dan Remaja (>6 - <18 tahun) </option>
                                <option value="Usia Dewasa (>18 - 59 tahun)"
                                    {{ old('kelompok_sasaran') ?? $data->kelompok_sasaran == 'Usia Dewasa (>18 - 59 tahun)' ? 'selected' : '' }}>
                                    Usia Dewasa (>18 - 59 tahun)</option>
                                <option value="Usia Lansia"
                                    {{ old('kelompok_sasaran') ?? $data->kelompok_sasaran == 'Usia Lansia' ? 'selected' : '' }}>
                                    Usia Lansia</option>
                            </select>
                            @error('kelompok_sasaran')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" onclick="setAction('save')">Simpan</button>
                <a href="{{ url()->previous() }}" class="btn btn-default">Kembali Ke List</a>


            </form>
        </div>
    </div>

    <!-- End of Main Content -->
@endsection
@section('scripts')
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function setAction(action) {
            // Show SweetAlert2 loading animation
            Swal.fire({
                title: 'Simpan...',
                text: 'Tunggu Data Sedang Di Simpan.',
                imageUrl: 'https://media.tenor.com/y6-Oq1X_9NcAAAAC/loading-loading-gif.gif',
                imageWidth: 100,
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });

            // Submit the form after showing the loading animation
            document.getElementById('modal-save-form').submit();
        }
    </script>
@endsection
