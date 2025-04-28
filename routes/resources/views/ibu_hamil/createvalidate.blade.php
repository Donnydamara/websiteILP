@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Create Data Ibu Hamil') }}</h1>

    <!-- Main Content goes here -->

    <div class="card" style="text-align: center">
        <div class="card-body" style="text-align: center;">
            <form action="{{ route('ibu_hamil.storevalidate') }}" method="post" id="modal-save-form">
                @csrf
                <div class="form-group">
                    <label for="status">Status Kunjungan TBC</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status"
                        required>
                        <option value="" disabled {{ old('status') === null ? 'selected' : '' }}>Pilih</option>
                        <option value="Ya" {{ old('status') === 'Ya' || old('status') === null ? 'selected' : '' }}>Ya
                        </option>
                        <option value="Tidak" {{ old('status') === 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="card" style="text-align: center">

                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                        name="nik" id="nik" value="{{ old('nik') }}" required>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kk">Kartu Keluarga</label>
                                <input type="number" class="form-control @error('kk') is-invalid @enderror" name="kk"
                                    id="kk" placeholder="kk" value="{{ old('kk') }}" required>
                                @error('kk')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" placeholder="Nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kehamilan_ke">Kehamilan Anak Ke</label>
                                <input type="number" class="form-control @error('kehamilan_ke') is-invalid @enderror"
                                    name="kehamilan_ke" id="kehamilan_ke" placeholder="Kehamilan Ke" autocomplete="off"
                                    value="{{ old('kehamilan_ke') }}" required>
                                @error('kehamilan_ke')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jarak_kehamilan">Jarak Kehamilan Dengan Kehamilan Sebelumnya</label>

                                <select class="form-control" id="jarak_kehamilan_unit" name="jarak_kehamilan_unit"
                                    onchange="toggleInput()">
                                    <option value="bulan">Bulan</option>
                                    <option value="tahun">Tahun</option>
                                </select>

                                <input type="number"
                                    class="form-control mt-2 @error('jarak_kehamilan_bulan') is-invalid @enderror"
                                    name="jarak_kehamilan_bulan" id="jarak_kehamilan_bulan"
                                    placeholder="Masukkan dalam bulan" autocomplete="off"
                                    value="{{ old('jarak_kehamilan_bulan') }}">

                                <input type="number"
                                    class="form-control mt-2 d-none @error('jarak_kehamilan_tahun') is-invalid @enderror"
                                    name="jarak_kehamilan_tahun" id="jarak_kehamilan_tahun"
                                    placeholder="Masukkan dalam tahun" autocomplete="off"
                                    value="{{ old('jarak_kehamilan_tahun') }}">

                                @error('jarak_kehamilan_bulan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('jarak_kehamilan_tahun')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="umur">Umur Ibu</label>
                                <input type="number" class="form-control @error('umur') is-invalid @enderror"
                                    name="umur" id="umur" placeholder="Umur" autocomplete="off"
                                    value="{{ old('umur') }}" required>
                                @error('umur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kunjungan">Kunjungan</label>
                                <input type="number" class="form-control @error('kunjungan') is-invalid @enderror"
                                    name="kunjungan" id="kunjungan" placeholder="Kunjungan" autocomplete="off"
                                    value="{{ old('kunjungan') }}" required>
                                @error('kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_kunjungan">Tanggal Kunjungan</label>
                                <input type="date" class="form-control @error('tgl_kunjungan') is-invalid @enderror"
                                    name="tgl_kunjungan" id="tgl_kunjungan" placeholder="tgl_Kunjungan"
                                    autocomplete="off" value="{{ old('tgl_kunjungan') }}" required>
                                @error('tgl_kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="suhu_tubuh">Suhu Tubuh</label>
                                <select class="form-control @error('suhu_tubuh') is-invalid @enderror" name="suhu_tubuh"
                                    id="suhu_tubuh" required>
                                    <option value="">Pilih Suhu Tubuh</option>
                                    <option value="<37,5 C" {{ old('suhu_tubuh') == '<37,5 C' ? 'selected' : '' }}>
                                        &lt;
                                        37,5 C
                                    </option>
                                    <option value=">37,5 C" {{ old('suhu_tubuh') == '>37,5 C' ? 'selected' : '' }}>
                                        &gt;
                                        37,5 C
                                    </option>
                                </select>
                                @error('suhu_tubuh')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Ada Buku KIA</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control @error('kia') is-invalid @enderror" name="kia"
                                    id="kia" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('kia') == 'Ada' ? 'selected' : '' }}>Ada
                                    </option>
                                    <option value="Tidak" {{ old('kia') == 'Tidak' ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>
                                @error('kia')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Ibu Memeriksa Kehamilan</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 2%">
                        <div class="row" style="margin: 1%">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jenis_imk">Ibu Memeriksa Kehamilan</label>
                                    <select class="form-control @error('jenis_imk') is-invalid @enderror"
                                        name="jenis_imk" id="jenis_imk" required>
                                        <option value="">Pilih Trimester</option>
                                        <option value="K1 (Trimester I (1 kali pada umur kehamilan hingga 12 minggu))"
                                            {{ old('jenis_imk') == 'K1 (Trimester I (1 kali pada umur kehamilan hingga 12 minggu))' ? 'selected' : '' }}>
                                            K1 (Trimester I (1 kali pada umur kehamilan hingga 12 minggu))
                                        </option>
                                        <option
                                            value="K2 (Trimester II (2 kali pada umur kehamilan hingga 12 - 24 minggu))"
                                            {{ old('jenis_imk') == 'K2 (Trimester II (2 kali pada umur kehamilan hingga 12 - 24 minggu))' ? 'selected' : '' }}>
                                            K2 (Trimester II (2 kali pada umur kehamilan hingga 12 - 24 minggu))
                                        </option>
                                        <option
                                            value="K3 (Trimester II (2 kali pada umur kehamilan hingga 12 - 24 minggu))"
                                            {{ old('jenis_imk') == 'K3 (Trimester II (2 kali pada umur kehamilan hingga 12 - 24 minggu))' ? 'selected' : '' }}>
                                            K3 (Trimester II (2 kali pada umur kehamilan hingga 12 - 24 minggu))
                                        </option>
                                        <option
                                            value="K4 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))"
                                            {{ old('jenis_imk') == 'K4 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))' ? 'selected' : '' }}>
                                            K4 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))
                                        </option>
                                        <option
                                            value="K5 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))"
                                            {{ old('jenis_imk') == 'K5 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))' ? 'selected' : '' }}>
                                            K5 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))
                                        </option>
                                        <option
                                            value="K6 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))"
                                            {{ old('jenis_imk') == 'K6 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))' ? 'selected' : '' }}>
                                            K6 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))
                                        </option>
                                    </select>
                                    @error('jenis_imk')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_imk">Tanggal</label>
                                    <input type="date" class="form-control @error('tgl_imk') is-invalid @enderror"
                                        name="tgl_imk" id="tgl_imk" autocomplete="off" value="{{ old('tgl_imk') }}"
                                        required>
                                    @error('tgl_imk')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="tempat_imk">Tempat</label>
                                    <select class="form-control @error('tempat_imk') is-invalid @enderror"
                                        name="tempat_imk" id="tempat_imk" required>
                                        <option value="">Pilih Tempat</option>
                                        <option value="Rumah sakit"
                                            {{ old('tempat_imk') == 'Rumah sakit' ? 'selected' : '' }}>Rumah
                                            sakit</option>
                                        <option value="Puskesmas"
                                            {{ old('tempat_imk') == 'Puskesmas' ? 'selected' : '' }}>
                                            Puskesmas</option>
                                        <option value="Polindes" {{ old('tempat_imk') == 'Polindes' ? 'selected' : '' }}>
                                            Polindes</option>
                                        <option value="Dokter Praktik"
                                            {{ old('tempat_imk') == 'Dokter Praktik' ? 'selected' : '' }}>
                                            Dokter Praktik
                                        </option>
                                        <option value="Bidan praktik mandiri"
                                            {{ old('tempat_imk') == 'Bidan praktik mandiri' ? 'selected' : '' }}>Bidan
                                            praktik
                                            mandiri</option>
                                        <option value="Kader" {{ old('tempat_imk') == 'Kader' ? 'selected' : '' }}>Rumah
                                        </option>
                                    </select>
                                    @error('tempat_imk')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="petugas_imk">Petugas</label>
                                    <select class="form-control @error('petugas_imk') is-invalid @enderror"
                                        name="petugas_imk" id="petugas_imk" required>
                                        <option value="">Pilih Petugas</option>
                                        <option value="docter" {{ old('petugas_imk') == 'docter' ? 'selected' : '' }}>
                                            Docter
                                        </option>
                                        <option value="bidan" {{ old('petugas_imk') == 'bidan' ? 'selected' : '' }}>
                                            Bidan
                                        </option>
                                        <option value="perawat" {{ old('petugas_imk') == 'perawat' ? 'selected' : '' }}>
                                            Perawat</option>
                                        <option value="Kader" {{ old('petugas_imk') == 'Kader' ? 'selected' : '' }}>
                                            Kader</option>
                                    </select>
                                    @error('petugas_imk')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>TTD</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="ada_ttd">Ada TTD</label>
                                    <select class="form-control @error('ada_ttd') is-invalid @enderror" name="ada_ttd"
                                        id="ada_ttd" required>
                                        <option value="">Pilih Opsi</option>
                                        <option value="Ada" {{ old('ada_ttd') == 'Ada' ? 'selected' : '' }}>Ada
                                        </option>
                                        <option value="Tidak" {{ old('ada_ttd') == 'Tidak' ? 'selected' : '' }}>
                                            Tidak
                                        </option>
                                    </select>
                                    @error('ada_ttd')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="minum_ttd">Minum TTD</label>
                                    <select class="form-control @error('minum_ttd') is-invalid @enderror"
                                        name="minum_ttd" id="minum_ttd" required>
                                        <option value="">Pilih Opsi</option>
                                        <option value="Ada" {{ old('minum_ttd') == 'Ada' ? 'selected' : '' }}>
                                            Ada
                                        </option>
                                        <option value="Tidak" {{ old('minum_ttd') == 'Tidak' ? 'selected' : '' }}>
                                            Tidak
                                        </option>
                                    </select>
                                    @error('minum_ttd')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="porsi">Isi Piringku Untuk Ibu Hamil</label>
                                    <select class="form-control @error('porsi') is-invalid @enderror" name="porsi"
                                        id="porsi" required>
                                        <option value="">Pilih Opsi</option>
                                        <option value="Sesuai" {{ old('porsi') == 'Sesuai' ? 'selected' : '' }}>
                                            Sesuai
                                        </option>
                                        <option value="Tidak" {{ old('porsi') == 'Tidak' ? 'selected' : '' }}>
                                            Tidak
                                        </option>
                                    </select>
                                    @error('porsi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lila">LILA < 23,4 cm</label>
                                        <select class="form-control @error('lila') is-invalid @enderror" name="lila"
                                            id="lila" required>
                                            <option value="">Pilih Opsi</option>
                                            <option value="Ada" {{ old('lila') == 'Ada' ? 'selected' : '' }}>
                                                Ada
                                            </option>
                                            <option value="Tidak" {{ old('lila') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak
                                            </option>
                                        </select>
                                        @error('lila')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pmt">PMT Untuk Bumil KEK</label>
                                <select class="form-control @error('pmt') is-invalid @enderror" name="pmt"
                                    id="pmt" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('pmt') == 'Ada' ? 'selected' : '' }}>Ada
                                    </option>
                                    <option value="Tidak" {{ old('pmt') == 'Tidak' ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>
                                @error('pmt')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Mengikuti Kelas Ibu Hamil Terakhir</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kls_ibu_hamil">Tanggal</label>
                                <input type="date" class="form-control @error('kls_ibu_hamil') is-invalid @enderror"
                                    name="kls_ibu_hamil" id="kls_ibu_hamil" placeholder="kls ibu hamil"
                                    autocomplete="off" value="{{ old('kls_ibu_hamil') }}" required>
                                @error('kls_ibu_hamil')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tempat_ibu_hamil">Tempat</label>
                                <select class="form-control @error('tempat_ibu_hamil') is-invalid @enderror"
                                    name="tempat_ibu_hamil" id="tempat_ibu_hamil" required>
                                    <option value="">Pilih Tempat</option>
                                    <option value="Kantor desa"
                                        {{ old('tempat_ibu_hamil') == 'Kantor desa' ? 'selected' : '' }}>
                                        Kantor desa
                                    </option>
                                    <option value="posyandu"
                                        {{ old('tempat_ibu_hamil') == 'posyandu' ? 'selected' : '' }}>
                                        Posyandu</option>
                                </select>
                                @error('tempat_ibu_hamil')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pendamping_ibu_hamil">Pendamping</label>
                                <select class="form-control @error('pendamping_ibu_hamil') is-invalid @enderror"
                                    name="pendamping_ibu_hamil" id="pendamping_ibu_hamil" required>
                                    <option value="">Pilih Pendamping</option>
                                    <option value="suami" {{ old('pendamping_ibu_hamil') == 'suami' ? 'selected' : '' }}>
                                        Suami</option>
                                    <option value="saudara"
                                        {{ old('pendamping_ibu_hamil') == 'saudara' ? 'selected' : '' }}>
                                        Saudara</option>
                                </select>
                                @error('pendamping_ibu_hamil')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Melakukan Skrining Kesehatan Jiwa</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 2%">
                        <div class="row" style="margin: 1%">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kls_skrining_kesehatan">Tanggal</label>
                                    <input type="date"
                                        class="form-control @error('kls_skrining_kesehatan') is-invalid @enderror"
                                        name="kls_skrining_kesehatan" id="kls_skrining_kesehatan"
                                        placeholder="kls_skrining_kesehatan" autocomplete="off"
                                        value="{{ old('kls_skrining_kesehatan') }}" required>
                                    @error('kls_skrining_kesehatan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tempat_skrining_kesehatan">Tempat</label>
                                    <select class="form-control @error('tempat_skrining_kesehatan') is-invalid @enderror"
                                        name="tempat_skrining_kesehatan" id="tempat_skrining_kesehatan" required>
                                        <option value="">Pilih Tempat</option>
                                        <option value="Rumah"
                                            {{ old('tempat_skrining_kesehatan') == 'Rumah' ? 'selected' : '' }}>
                                            Rumah
                                        </option>
                                        <option value="Posyandu"
                                            {{ old('tempat_skrining_kesehatan') == 'Posyandu' ? 'selected' : '' }}>
                                            Posyandu
                                        </option>
                                    </select>
                                    @error('tempat_skrining_kesehatan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="petugas_skrining_kesehatan">Petugas</label>
                                    <select class="form-control @error('petugas_skrining_kesehatan') is-invalid @enderror"
                                        name="petugas_skrining_kesehatan" id="petugas_skrining_kesehatan" required>
                                        <option value="">Pilih Petugas</option>
                                        <option value="Petugas Puskesmas"
                                            {{ old('petugas_skrining_kesehatan') == 'Petugas Puskesmas' ? 'selected' : '' }}>
                                            Petugas Puskesmas</option>
                                        <option value="Kader"
                                            {{ old('petugas_skrining_kesehatan') == 'Kader' ? 'selected' : '' }}>
                                            Kader
                                        </option>
                                    </select>
                                    @error('petugas_skrining_kesehatan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edukasi">Pemberian Edukasi/Kunjungan Nakes</label>
                                <input type="text" class="form-control @error('edukasi') is-invalid @enderror"
                                    name="edukasi" id="edukasi" placeholder="Pemberian Edukasi/Kunjungan Nakes"
                                    autocomplete="off" value="{{ old('edukasi') }}" required>
                                @error('edukasi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="demam_l2">Demam Lebih Dari Dua Hari</label>
                                <select class="form-control @error('demam_l2') is-invalid @enderror" name="demam_l2"
                                    id="demam_l2" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('demam_l2') == 'Ada' ? 'selected' : '' }}>
                                        Ada
                                    </option>
                                    <option value="Tidak" {{ old('demam_l2') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('demam_l2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sakit_kepala_l2">Pusing/Sakit Kepala Berat</label>
                                <select class="form-control @error('sakit_kepala_l2') is-invalid @enderror"
                                    name="sakit_kepala_l2" id="sakit_kepala_l2" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('sakit_kepala_l2') == 'Ada' ? 'selected' : '' }}>Ada
                                    </option>
                                    <option value="Tidak" {{ old('sakit_kepala_l2') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('sakit_kepala_l2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sulit_tidur_l2">Sulit Tidur/Cemas Berlebih</label>
                                <select class="form-control @error('sulit_tidur_l2') is-invalid @enderror"
                                    name="sulit_tidur_l2" id="sulit_tidur_l2" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('sulit_tidur_l2') == 'Ada' ? 'selected' : '' }}>
                                        Ada
                                    </option>
                                    <option value="Tidak" {{ old('sulit_tidur_l2') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('sulit_tidur_l2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="diare_l2">Diare Berulang</label>
                                <select class="form-control @error('diare_l2') is-invalid @enderror" name="diare_l2"
                                    id="diare_l2" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('diare_l2') == 'Ada' ? 'selected' : '' }}>
                                        Ada
                                    </option>
                                    <option value="Tidak" {{ old('diare_l2') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('diare_l2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tbc_l2">Resiko TBC</label>
                                <select class="form-control @error('tbc_l2') is-invalid @enderror" name="tbc_l2"
                                    id="tbc_l2" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('tbc_l2') == 'Ada' ? 'selected' : '' }}>Ada
                                    </option>
                                    <option value="Tidak" {{ old('tbc_l2') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('tbc_l2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gerakan_janin_l2">Tidak Ada Gerakan Janin</label>
                                <select class="form-control @error('gerakan_janin_l2') is-invalid @enderror"
                                    name="gerakan_janin_l2" id="gerakan_janin_l2" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('gerakan_janin_l2') == 'Ada' ? 'selected' : '' }}>
                                        Ada
                                    </option>
                                    <option value="Tidak" {{ old('gerakan_janin_l2') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('gerakan_janin_l2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jantung_sakit_l2">Jantung Berdebar-Debar Dari Jalan Lahir</label>
                                <select class="form-control @error('jantung_sakit_l2') is-invalid @enderror"
                                    name="jantung_sakit_l2" id="jantung_sakit_l2" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('jantung_sakit_l2') == 'Ada' ? 'selected' : '' }}>
                                        Ada
                                    </option>
                                    <option value="Tidak" {{ old('jantung_sakit_l2') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('jantung_sakit_l2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="keluar_cairan_l2">Keluar Cairan Dari Jalan Lahir</label>
                                <select class="form-control @error('keluar_cairan_l2') is-invalid @enderror"
                                    name="keluar_cairan_l2" id="keluar_cairan_l2" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('keluar_cairan_l2') == 'Ada' ? 'selected' : '' }}>
                                        Ada
                                    </option>
                                    <option value="Tidak" {{ old('keluar_cairan_l2') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('keluar_cairan_l2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kencing_manis_l2">Sakit Saat Kencing Manis</label>
                                <select class="form-control @error('kencing_manis_l2') is-invalid @enderror"
                                    name="kencing_manis_l2" id="kencing_manis_l2" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('kencing_manis_l2') == 'Ada' ? 'selected' : '' }}>
                                        Ada
                                    </option>
                                    <option value="Tidak" {{ old('kencing_manis_l2') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('kencing_manis_l2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nyeri_perut_l2">Nyeri Perut Hebat</label>
                                <select class="form-control @error('nyeri_perut_l2') is-invalid @enderror"
                                    name="nyeri_perut_l2" id="nyeri_perut_l2" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('nyeri_perut_l2') == 'Ada' ? 'selected' : '' }}>
                                        Ada
                                    </option>
                                    <option value="Tidak" {{ old('nyeri_perut_l2') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('nyeri_perut_l2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="periksa_l2">Mengingatkan Periksa Ke Postu/Fasyankes</label>
                                <select class="form-control @error('periksa_l2') is-invalid @enderror" name="periksa_l2"
                                    id="periksa_l2" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Ada" {{ old('periksa_l2') == 'Ada' ? 'selected' : '' }}>
                                        Ada
                                    </option>
                                    <option value="Tidak" {{ old('periksa_l2') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('periksa_l2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lapor_nakes">Melaporkan Ke Nakes</label>
                                <input type="date" class="form-control @error('lapor_nakes') is-invalid @enderror"
                                    name="lapor_nakes" id="lapor_nakes" placeholder="lapor_nakes" autocomplete="off"
                                    value="{{ old('lapor_nakes') }}" required>
                                @error('lapor_nakes')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="setAction('save')">Simpan</button>
                    <a href="{{ route('ibu_hamil.index') }}" class="btn btn-default">Kembali Ke List</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var statusSelect = document.getElementById('status');
            var fields = {
                'btnCekData': document.getElementById('btnCekData'),
                'kk': document.getElementById('kk'),
                'nik': document.getElementById('nik'),
                'nama': document.getElementById('nama'),
                'kehamilan_ke': document.getElementById('kehamilan_ke'),
                // 'jarak_kehamilan': document.getElementById('jarak_kehamilan'),
                'jarak_kehamilan_unit': document.getElementById('jarak_kehamilan_unit'),
                'jarak_kehamilan_bulan': document.getElementById('jarak_kehamilan_bulan'),
                'jarak_kehamilan_tahun': document.getElementById('jarak_kehamilan_tahun'),
                'umur': document.getElementById('umur'),
                'kunjungan': document.getElementById('kunjungan'),
                'tgl_kunjungan': document.getElementById('tgl_kunjungan'),
                'suhu_tubuh': document.getElementById('suhu_tubuh'),
                'kia': document.getElementById('kia'),
                'jenis_imk': document.getElementById('jenis_imk'),
                'tgl_imk': document.getElementById('tgl_imk'),
                'tempat_imk': document.getElementById('tempat_imk'),
                'petugas_imk': document.getElementById('petugas_imk'),
                'porsi': document.getElementById('porsi'),
                'ada_ttd': document.getElementById('ada_ttd'),
                'minum_ttd': document.getElementById('minum_ttd'),
                'lila': document.getElementById('lila'),
                'pmt': document.getElementById('pmt'),
                'kls_ibu_hamil': document.getElementById('kls_ibu_hamil'),
                'tempat_ibu_hamil': document.getElementById('tempat_ibu_hamil'),
                'pendamping_ibu_hamil': document.getElementById('pendamping_ibu_hamil'),
                'kls_skrining_kesehatan': document.getElementById('kls_skrining_kesehatan'),
                'tempat_skrining_kesehatan': document.getElementById('tempat_skrining_kesehatan'),
                'petugas_skrining_kesehatan': document.getElementById('petugas_skrining_kesehatan'),
                'edukasi': document.getElementById('edukasi'),
                'demam_l2': document.getElementById('demam_l2'),
                'sakit_kepala_l2': document.getElementById('sakit_kepala_l2'),
                'sulit_tidur_l2': document.getElementById('sulit_tidur_l2'),
                'diare_l2': document.getElementById('diare_l2'),
                'tbc_l2': document.getElementById('tbc_l2'),
                'gerakan_janin_l2': document.getElementById('gerakan_janin_l2'),
                'jantung_sakit_l2': document.getElementById('jantung_sakit_l2'),
                'keluar_cairan_l2': document.getElementById('keluar_cairan_l2'),
                'kencing_manis_l2': document.getElementById('kencing_manis_l2'),
                'nyeri_perut_l2': document.getElementById('nyeri_perut_l2'),
                'periksa_l2': document.getElementById('periksa_l2'),
                'lapor_nakes': document.getElementById('lapor_nakes')
            };

            // Set nilai dropdown "Status Ibu Bersalin Nifas" menggunakan old value jika ada
            var oldStatusValue = "{{ old('status') }}";
            if (oldStatusValue !== '') {
                statusSelect.value = oldStatusValue;
            }

            function toggleFormFields(status) {
                var isActive = status === 'Ya';
                for (var key in fields) {
                    fields[key].required = isActive;
                    fields[key].disabled = !isActive;
                    if (!isActive) {
                        fields[key].value = ''; // Hapus nilai jika statusnya tidak aktif
                    }
                }
            }

            statusSelect.addEventListener('change', function() {
                toggleFormFields(statusSelect.value);
            });

            // Initial check
            toggleFormFields(statusSelect.value);

            document.getElementById('btnCekData').addEventListener('click', function() {
                var nik = document.getElementById('nik').value;

                Swal.fire({
                    title: 'Pengecekan...',
                    text: 'Data Sedang Di cek.',
                    imageUrl: 'https://media.tenor.com/y6-Oq1X_9NcAAAAC/loading-loading-gif.gif',
                    imageWidth: 100,
                    imageHeight: 100,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                fetch('{{ route('ibu_hamil.checkKK') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            nik: nik
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.close(); // Menutup loading SweetAlert2

                        if (data.status === 'success') {
                            document.getElementById('nama').value = data.data.nama;
                            document.getElementById('kk').value = data.data.kk;
                            Swal.fire({
                                icon: 'success',
                                title: 'NIK Ditemukan',
                                text: 'Nama: ' + data.data.nama
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message
                            });
                        }
                    })
                    .catch(error => {
                        Swal.close(); // Menutup loading SweetAlert2
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat memeriksa NIK.'
                        });
                        console.error('Error:', error);
                    });
            });

            document.getElementById('modal-save-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah submit default

                Swal.fire({
                    title: 'Simpan...',
                    text: 'Data Sedang Disimpan.',
                    imageUrl: 'https://media.tenor.com/y6-Oq1X_9NcAAAAC/loading-loading-gif.gif',
                    imageWidth: 100,
                    imageHeight: 100,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                // Submit form setelah menampilkan animasi loading
                this.submit();
            });

            //================================
            function toggleInput() {
                var unit = document.getElementById('jarak_kehamilan_unit').value;
                var bulanInput = document.getElementById('jarak_kehamilan_bulan');
                var tahunInput = document.getElementById('jarak_kehamilan_tahun');

                if (unit === 'bulan') {
                    bulanInput.classList.remove('d-none');
                    tahunInput.classList.add('d-none');
                } else {
                    bulanInput.classList.add('d-none');
                    tahunInput.classList.remove('d-none');
                }
            }

            // Initialize the input visibility based on the current selection
            toggleInput();
        });
    </script>

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
                text: 'Data Sedang Disimpan.',
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
