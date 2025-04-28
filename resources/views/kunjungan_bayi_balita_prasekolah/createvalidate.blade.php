@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Tambah Data Kunjungan Bayi Dan Anak Usia Prasekolah') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('kunjungan_bayi_balita_prasekolah.storevalidate') }}" method="post" id="modal-save-form">
                @csrf
                <div class="form-group">
                    <label for="status">Status Bayi Dan Anak Usia Prasekolah</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" required>
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
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                    name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                                @error('tgl_lahir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tmp_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control @error('tmp_lahir') is-invalid @enderror"
                                    name="tmp_lahir" id="tmp_lahir" placeholder="Tempat Lahir" autocomplete="off"
                                    value="{{ old('tmp_lahir') }}" required>
                                @error('tmp_lahir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender"
                                    id="gender" required>
                                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('gender')
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
                                <label for="tgl_kunjungan">Tanggal</label>
                                <input type="date" class="form-control @error('tgl_kunjungan') is-invalid @enderror"
                                    name="tgl_kunjungan" id="tgl_kunjungan" value="{{ old('tgl_kunjungan') }}" required>
                                @error('tgl_kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="suhu_tubuh">suhu</label>
                                <select class="form-control @error('suhu_tubuh') is-invalid @enderror" name="suhu_tubuh"
                                    id="suhu_tubuh" required>
                                    <option value="<37,5 C" {{ old('suhu_tubuh') == '<37,5 C' ? 'selected' : '' }}>
                                        &lt;37,5 C</option>
                                    <option value=">37,5 C" {{ old('suhu_tubuh') == '>37,5 C' ? 'selected' : '' }}>
                                        &gt;37,5 C</option>
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
                                <select class="form-control @error('buku_kia') is-invalid @enderror" name="buku_kia"
                                    id="buku_kia" required>
                                    <option value="Ya" {{ old('buku_kia') == 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak" {{ old('buku_kia') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('buku_kia')
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
                                <label for="tgl_timbang_ukur">Tanggal</label>
                                <input type="date"
                                    class="form-control @error('tgl_timbang_ukur') is-invalid @enderror"
                                    name="tgl_timbang_ukur" id="tgl_timbang_ukur" value="{{ old('tgl_timbang_ukur') }}"
                                    required>
                                @error('tgl_timbang_ukur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tempat_timbang_ukur">Tempat</label>
                                <select class="form-control @error('tempat_timbang_ukur') is-invalid @enderror"
                                    name="tempat_timbang_ukur" id="tempat_timbang_ukur" required>
                                    <option value="Puskesmas/Postu"
                                        {{ old('tempat_timbang_ukur') == 'Puskesmas/Postu' ? 'selected' : '' }}>
                                        Puskesmas/Postu</option>
                                    <option value="Ponkesdes/Polindes"
                                        {{ old('tempat_timbang_ukur') == 'Ponkesdes/Polindes' ? 'selected' : '' }}>
                                        Ponkesdes/Polindes</option>
                                    <option value="BPM" {{ old('tempat_timbang_ukur') == 'BPM' ? 'selected' : '' }}>
                                        BPM</option>
                                    <option value="Posyandu"
                                        {{ old('tempat_timbang_ukur') == 'Posyandu' ? 'selected' : '' }}>
                                        Posyandu</option>
                                    <option value="Rumah" {{ old('tempat_timbang_ukur') == 'Rumah' ? 'selected' : '' }}>
                                        Rumah</option>
                                </select>
                                @error('tempat_timbang_ukur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="petugas_timbang_ukur">Petugas</label>
                                <select class="form-control @error('petugas_timbang_ukur') is-invalid @enderror"
                                    name="petugas_timbang_ukur" id="petugas_timbang_ukur" required>
                                    <option value="Bidan" {{ old('petugas_timbang_ukur') == 'Bidan' ? 'selected' : '' }}>
                                        Bidan</option>
                                    <option value="Perawat"
                                        {{ old('petugas_timbang_ukur') == 'Perawat' ? 'selected' : '' }}>
                                        Perawat</option>
                                    <option value="Kader" {{ old('petugas_timbang_ukur') == 'Kader' ? 'selected' : '' }}>
                                        Kader</option>
                                </select>
                                @error('petugas_timbang_ukur')
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
                                <h5>Hasil Penimbangan Dan Pengukuran</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bb_hasil_timbang_ukur">BB</label>
                                <input type="number"
                                    class="form-control @error('bb_hasil_timbang_ukur') is-invalid @enderror"
                                    name="bb_hasil_timbang_ukur" id="bb_hasil_timbang_ukur" placeholder="BB"
                                    autocomplete="off" value="{{ old('bb_hasil_timbang_ukur') }}" required>
                                @error('bb_hasil_timbang_ukur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pb_tb_hasil_timbang_ukur">PB</label>
                                <input type="number"
                                    class="form-control @error('pb_tb_hasil_timbang_ukur') is-invalid @enderror"
                                    name="pb_tb_hasil_timbang_ukur" id="pb_tb_hasil_timbang_ukur" placeholder="PB"
                                    autocomplete="off" value="{{ old('pb_tb_hasil_timbang_ukur') }}" required>
                                @error('pb_tb_hasil_timbang_ukur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lk_hasil_timbang_ukur">LK</label>
                                <input type="number"
                                    class="form-control @error('lk_hasil_timbang_ukur') is-invalid @enderror"
                                    name="lk_hasil_timbang_ukur" id="lk_hasil_timbang_ukur" placeholder="LK"
                                    autocomplete="off" value="{{ old('lk_hasil_timbang_ukur') }}" required>
                                @error('lk_hasil_timbang_ukur')
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
                                <h5>Imunisasi</h5>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="jenis_imunisasi">Jenis Imunisasi</label>
                                <select class="form-control @error('jenis_imunisasi') is-invalid @enderror"
                                    name="jenis_imunisasi" id="jenis_imunisasi" required>
                                    <option value="Usia 0 Bulan"
                                        {{ old('jenis_imunisasi') == 'Usia 0 Bulan' ? 'selected' : '' }}>
                                        Usia 0 Bulan</option>
                                    <option value="Usia 1 Bulan"
                                        {{ old('jenis_imunisasi') == 'Usia 1 Bulan' ? 'selected' : '' }}>
                                        Usia 1 Bulan</option>
                                    <option value="Usia 2 Bulan"
                                        {{ old('jenis_imunisasi') == 'Usia 2 Bulan' ? 'selected' : '' }}>
                                        Usia 2 Bulan</option>
                                    <option value="Usia 3 Bulan"
                                        {{ old('jenis_imunisasi') == 'Usia 3 Bulan' ? 'selected' : '' }}>
                                        Usia 3 Bulan</option>
                                    <option value="Usia 4 Bulan"
                                        {{ old('jenis_imunisasi') == 'Usia 4 Bulan' ? 'selected' : '' }}>
                                        Usia 4 Bulan</option>
                                    <option value="Usia 9 Bulan"
                                        {{ old('jenis_imunisasi') == 'Usia 9 Bulan' ? 'selected' : '' }}>
                                        Usia 9 Bulan</option>
                                    <option value="Usia 10 Bulan"
                                        {{ old('jenis_imunisasi') == 'Usia 10 Bulan' ? 'selected' : '' }}>
                                        Usia 10 Bulan</option>
                                    <option value="Usia 12 Bulan"
                                        {{ old('jenis_imunisasi') == 'Usia 12 Bulan' ? 'selected' : '' }}>
                                        Usia 12 Bulan</option>
                                    <option value="Usia 18 Bulan"
                                        {{ old('jenis_imunisasi') == 'Usia 18 Bulan' ? 'selected' : '' }}>
                                        Usia 18 Bulan</option>
                                </select>
                                @error('jenis_imunisasi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div> --}}

                    <div class="card" style="margin: 2%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Imunisasi 0 Bulan</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hepatitis_b_0bulan">Hepatitis B (<24 Jam)</label>
                                            <input type="date"
                                                class="form-control @error('hepatitis_b_0bulan') is-invalid @enderror"
                                                name="hepatitis_b_0bulan" id="hepatitis_b_0bulan"
                                                value="{{ old('hepatitis_b_0bulan') }}">
                                            @error('hepatitis_b_0bulan')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bcg_0bulan">BCG</label>
                                    <input type="date" class="form-control @error('bcg_0bulan') is-invalid @enderror"
                                        name="bcg_0bulan" id="bcg_0bulan" value="{{ old('bcg_0bulan') }}">
                                    @error('bcg_0bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="polio_0bulan">Polio Tetes 1</label>
                                    <input type="date"
                                        class="form-control @error('polio_0bulan') is-invalid @enderror"
                                        name="polio_0bulan" id="polio_0bulan" value="{{ old('polio_0bulan') }}">
                                    @error('polio_0bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Imunisasi 1 Bulan</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bcg_1bulan">BCG</label>
                                    <input type="date" class="form-control @error('bcg_1bulan') is-invalid @enderror"
                                        name="bcg_1bulan" id="bcg_1bulan" value="{{ old('bcg_1bulan') }}">
                                    @error('bcg_1bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Field polio_1bulan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="polio_1bulan">Polio Tetes 1</label>
                                    <input type="date"
                                        class="form-control @error('polio_1bulan') is-invalid @enderror"
                                        name="polio_1bulan" id="polio_1bulan" value="{{ old('polio_1bulan') }}">
                                    @error('polio_1bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Imunisasi 2 Bulan</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dpt_hb_hib_1_2bulan">DPT HB Hib 1</label>
                                    <input type="date"
                                        class="form-control @error('dpt_hb_hib_1_2bulan') is-invalid @enderror"
                                        name="dpt_hb_hib_1_2bulan" id="dpt_hb_hib_1_2bulan"
                                        value="{{ old('dpt_hb_hib_1_2bulan') }}">
                                    @error('dpt_hb_hib_1_2bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="polio_2_2bulan">Polio Tetes 2</label>
                                    <input type="date"
                                        class="form-control @error('polio_2_2bulan') is-invalid @enderror"
                                        name="polio_2_2bulan" id="polio_2_2bulan" value="{{ old('polio_2_2bulan') }}">
                                    @error('polio_2_2bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pcv_1_2bulan">PCV 1</label>
                                    <input type="date"
                                        class="form-control @error('pcv_1_2bulan') is-invalid @enderror"
                                        name="pcv_1_2bulan" id="pcv_1_2bulan" value="{{ old('pcv_1_2bulan') }}">
                                    @error('pcv_1_2bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Field rv_1_2bulan -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rv_1_2bulan">RV 1</label>
                                    <input type="date" class="form-control @error('rv_1_2bulan') is-invalid @enderror"
                                        name="rv_1_2bulan" id="rv_1_2bulan" value="{{ old('rv_1_2bulan') }}">
                                    @error('rv_1_2bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Imunisasi 3 Bulan</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dpt_hb_hib_2_3bulan">DPT HB Hib 2</label>
                                    <input type="date"
                                        class="form-control @error('dpt_hb_hib_2_3bulan') is-invalid @enderror"
                                        name="dpt_hb_hib_2_3bulan" id="dpt_hb_hib_2_3bulan"
                                        value="{{ old('dpt_hb_hib_2_3bulan') }}">
                                    @error('dpt_hb_hib_2_3bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="polio_3_3bulan">Polio Tetes 3</label>
                                    <input type="date"
                                        class="form-control @error('polio_3_3bulan') is-invalid @enderror"
                                        name="polio_3_3bulan" id="polio_3_3bulan" value="{{ old('polio_3_3bulan') }}">
                                    @error('polio_3_3bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Field pcv_2_3bulan -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pcv_2_3bulan">PCV 2</label>
                                    <input type="date"
                                        class="form-control @error('pcv_2_3bulan') is-invalid @enderror"
                                        name="pcv_2_3bulan" id="pcv_2_3bulan" value="{{ old('pcv_2_3bulan') }}">
                                    @error('pcv_2_3bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rv_2_3bulan">RV 2</label>
                                    <input type="date" class="form-control @error('rv_2_3bulan') is-invalid @enderror"
                                        name="rv_2_3bulan" id="rv_2_3bulan" value="{{ old('rv_2_3bulan') }}">
                                    @error('rv_2_3bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Imunisasi 4 Bulan</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dpt_hb_hib_3_4bulan">DPT HB Hib 3</label>
                                    <input type="date"
                                        class="form-control @error('dpt_hb_hib_3_4bulan') is-invalid @enderror"
                                        name="dpt_hb_hib_3_4bulan" id="dpt_hb_hib_3_4bulan"
                                        value="{{ old('dpt_hb_hib_3_4bulan') }}">
                                    @error('dpt_hb_hib_3_4bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="polio_4_4bulan">Polio Tetes 4</label>
                                    <input type="date"
                                        class="form-control @error('polio_4_4bulan') is-invalid @enderror"
                                        name="polio_4_4bulan" id="polio_4_4bulan" value="{{ old('polio_4_4bulan') }}">
                                    @error('polio_4_4bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Field polio_suntik_4bulan -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="polio_suntik_4bulan">Polio Suntik (IPV) 1</label>
                                    <input type="date"
                                        class="form-control @error('polio_suntik_4bulan') is-invalid @enderror"
                                        name="polio_suntik_4bulan" id="polio_suntik_4bulan"
                                        value="{{ old('polio_suntik_4bulan') }}">
                                    @error('polio_suntik_4bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Field rv_3_4bulan -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rv_3_4bulan">RV 3</label>
                                    <input type="date" class="form-control @error('rv_3_4bulan') is-invalid @enderror"
                                        name="rv_3_4bulan" id="rv_3_4bulan" value="{{ old('rv_3_4bulan') }}">
                                    @error('rv_3_4bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Imunisasi 9 Bulan</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="campak_rubelia_9bulan">Campak Rubella</label>
                                    <input type="date"
                                        class="form-control @error('campak_rubelia_9bulan') is-invalid @enderror"
                                        name="campak_rubelia_9bulan" id="campak_rubelia_9bulan"
                                        value="{{ old('campak_rubelia_9bulan') }}">
                                    @error('campak_rubelia_9bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="polio_suntik_2_9bulan">Polio Suntik (IPV) 2</label>
                                    <input type="date"
                                        class="form-control @error('polio_suntik_2_9bulan') is-invalid @enderror"
                                        name="polio_suntik_2_9bulan" id="polio_suntik_2_9bulan"
                                        value="{{ old('polio_suntik_2_9bulan') }}">
                                    @error('polio_suntik_2_9bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Imunisasi 10 Bulan</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="je_10bulan">Japanese Encephalitis (JE)</label>
                                    <input type="date" class="form-control @error('je_10bulan') is-invalid @enderror"
                                        name="je_10bulan" id="je_10bulan" value="{{ old('je_10bulan') }}">
                                    @error('je_10bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Imunisasi 12 Bulan</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pv_3_12bulan">PV 3</label>
                                    <input type="date"
                                        class="form-control @error('pv_3_12bulan') is-invalid @enderror"
                                        name="pv_3_12bulan" id="pv_3_12bulan" value="{{ old('pv_3_12bulan') }}">
                                    @error('pv_3_12bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Imunisasi 18 Bulan</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dpt_lanjut_1_18bulan">DPT-HB-hib 1 Lanjutan</label>
                                    <input type="date"
                                        class="form-control @error('dpt_lanjut_1_18bulan') is-invalid @enderror"
                                        name="dpt_lanjut_1_18bulan" id="dpt_lanjut_1_18bulan"
                                        value="{{ old('dpt_lanjut_1_18bulan') }}">
                                    @error('dpt_lanjut_1_18bulan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="campak_lanjut_18bulan">Campak-rubella Lanjutan</label>
                                    <input type="date"
                                        class="form-control @error('campak_lanjut_18bulan') is-invalid @enderror"
                                        name="campak_lanjut_18bulan" id="campak_lanjut_18bulan"
                                        value="{{ old('campak_lanjut_18bulan') }}">
                                    @error('campak_lanjut_18bulan')
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
                                    <h5>Pemberian Makan Pendamping ASI Kaya Protein Hewani</h5>
                                </div>
                            </div>
                        </div>

                        <div class="card" style="margin: 1%">
                            <div class="row" style="margin: 1%">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="makanan_pokok">Makanan Pokok (Beras/Kentang/Jagung)</label>
                                        <select class="form-control @error('makanan_pokok') is-invalid @enderror"
                                            name="makanan_pokok" id="makanan_pokok">
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="Ya" {{ old('makanan_pokok') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak"
                                                {{ old('makanan_pokok') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('makanan_pokok')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="makanan_protein_hewan">Makanan Sumber Protein Hewani
                                            (Telur/Ikan/Ayam/Daging/Udang/Hati/Susu Dan Produk Olahan)</label>
                                        <select class="form-control @error('makanan_protein_hewan') is-invalid @enderror"
                                            name="makanan_protein_hewan" id="makanan_protein_hewan">
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="Ya"
                                                {{ old('makanan_protein_hewan') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak"
                                                {{ old('makanan_protein_hewan') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('makanan_protein_hewan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="makanan_protein_nabati">Makanan Sumber Protein Nabati
                                            (Tahu/Tempe/Kacang
                                            Hijau/Kacang Panjang)</label>
                                        <select class="form-control @error('makanan_protein_nabati') is-invalid @enderror"
                                            name="makanan_protein_nabati" id="makanan_protein_nabati">
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="Ya"
                                                {{ old('makanan_protein_nabati') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak"
                                                {{ old('makanan_protein_nabati') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('makanan_protein_nabati')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="margin: 1%">
                            <div class="row" style="margin: 1%">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="makanan_lemak">Makanan Lemak (Minyak/Santan)</label>
                                        <select class="form-control @error('makanan_lemak') is-invalid @enderror"
                                            name="makanan_lemak" id="makanan_lemak">
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="Ya" {{ old('makanan_lemak') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak"
                                                {{ old('makanan_lemak') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('makanan_lemak')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sayur_buah">Sayur Dan Buah</label>
                                        <select class="form-control @error('sayur_buah') is-invalid @enderror"
                                            name="sayur_buah" id="sayur_buah">
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="Ya" {{ old('sayur_buah') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak" {{ old('sayur_buah') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('sayur_buah')
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
                                    <h5>Obat Cacing</h5>
                                </div>
                            </div>
                        </div>

                        <div class="card" style="margin: 1%">
                            <div class="row" style="margin: 1%">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="oc_ada">Ada</label>
                                        <select class="form-control @error('oc_ada') is-invalid @enderror" name="oc_ada"
                                            id="oc_ada">
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="Ya" {{ old('oc_ada') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak" {{ old('oc_ada') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('oc_ada')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="oc_tgl">Tanggal Minum</label>
                                    <input type="date" class="form-control @error('oc_tgl') is-invalid @enderror"
                                        name="oc_tgl" id="oc_tgl" placeholder="Edukasi Kunjungan"
                                        value="{{ old('oc_tgl') }}" required>
                                    @error('oc_tgl')
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
                                    <h5>Kapsul Vitamin A</h5>
                                </div>
                            </div>
                        </div>

                        <div class="card" style="margin: 1%">
                            <div class="row" style="margin: 1%">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kv_jenis">Jenis KV</label>
                                        <select class="form-control @error('kv_jenis') is-invalid @enderror"
                                            name="kv_jenis" id="kv_jenis">
                                            <option value="" disabled selected>Pilih Jenis KV</option>
                                            <option value="Usia 6 - 11 Bulan (Kapsul Biru)"
                                                {{ old('kv_jenis') == 'Usia 6 - 11 Bulan (Kapsul Biru)' ? 'selected' : '' }}>
                                                Usia 6 - 11 Bulan (Kapsul Biru)</option>
                                            <option value="Usia >11 Bulan (Kapsul Merah)"
                                                {{ old('kv_jenis') == 'Usia >11 Bulan (Kapsul Merah)' ? 'selected' : '' }}>
                                                Usia >11 Bulan (Kapsul Merah)</option>
                                        </select>
                                        @error('kv_jenis')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tgl_kv_mulai">Tanggal KV Mulai</label>
                                        <input type="date"
                                            class="form-control @error('tgl_kv_mulai') is-invalid @enderror"
                                            name="tgl_kv_mulai" id="tgl_kv_mulai" value="{{ old('tgl_kv_mulai') }}">
                                        @error('tgl_kv_mulai')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tgl_kv_selesai">Tanggal KV Selesai</label>
                                        <input type="date"
                                            class="form-control @error('tgl_kv_selesai') is-invalid @enderror"
                                            name="tgl_kv_selesai" id="tgl_kv_selesai"
                                            value="{{ old('tgl_kv_selesai') }}">
                                        @error('tgl_kv_selesai')
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
                                    <h5>Makanan Tambahan Pangan Lokal Bagi Balita Dengan Masalah Gizi</h5>
                                </div>
                            </div>
                        </div>

                        <div class="card" style="margin: 1%">
                            <div class="row" style="margin: 1%">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="makan_tambah_ada">Ada</label>
                                        <select class="form-control @error('makan_tambah_ada') is-invalid @enderror"
                                            name="makan_tambah_ada" id="makan_tambah_ada">
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Ya"
                                                {{ old('makan_tambah_ada') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak"
                                                {{ old('makan_tambah_ada') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('makan_tambah_ada')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="makan_tambah_kepatuhan">Kepatuhan MKonsumsi</label>
                                        <select class="form-control @error('makan_tambah_kepatuhan') is-invalid @enderror"
                                            name="makan_tambah_kepatuhan" id="makan_tambah_kepatuhan">
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Ya"
                                                {{ old('makan_tambah_kepatuhan') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak"
                                                {{ old('makan_tambah_kepatuhan') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('makan_tambah_kepatuhan')
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
                                    <label for="edukasi">Edukasi Kunjungan</label>
                                    <textarea class="form-control @error('edukasi') is-invalid @enderror" name="edukasi" id="edukasi" rows="3"
                                        placeholder="Edukasi Kunjungan" required>{{ old('edukasi') }}</textarea>
                                    @error('edukasi')
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
                                    <h5>Makanan Tambahan Pangan Lokal Bagi Balita Dengan Masalah Gizi</h5>
                                </div>
                            </div>
                        </div>

                        <div class="card" style="margin: 1%">
                            <div class="row" style="margin: 1%">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="napas">Napas</label>
                                        <select class="form-control @error('napas') is-invalid @enderror" name="napas"
                                            id="napas">
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Ya" {{ old('napas') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak" {{ old('napas') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('napas')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="batuk">Batuk</label>
                                        <select class="form-control @error('batuk') is-invalid @enderror" name="batuk"
                                            id="batuk">
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Ya" {{ old('batuk') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak" {{ old('batuk') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('batuk')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="diare">Diare</label>
                                        <select class="form-control @error('diare') is-invalid @enderror" name="diare"
                                            id="diare">
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Ya" {{ old('diare') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak" {{ old('diare') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('diare')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jmh_warna_kencing">Jumlah Warna Kencing</label>
                                        <select class="form-control @error('jmh_warna_kencing') is-invalid @enderror"
                                            name="jmh_warna_kencing" id="jmh_warna_kencing">
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Ya"
                                                {{ old('jmh_warna_kencing') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak"
                                                {{ old('jmh_warna_kencing') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('jmh_warna_kencing')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="warna_kulit">Warna Kulit</label>
                                        <select class="form-control @error('warna_kulit') is-invalid @enderror"
                                            name="warna_kulit" id="warna_kulit">
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Ya" {{ old('warna_kulit') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak" {{ old('warna_kulit') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('warna_kulit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="aktifitas">Aktifitas</label>
                                        <select class="form-control @error('aktifitas') is-invalid @enderror"
                                            name="aktifitas" id="aktifitas">
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Ya" {{ old('aktifitas') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak" {{ old('aktifitas') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('aktifitas')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hisapan_bayi">Hisapan Bayi</label>
                                        <select class="form-control @error('hisapan_bayi') is-invalid @enderror"
                                            name="hisapan_bayi" id="hisapan_bayi">
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Ya" {{ old('hisapan_bayi') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak"
                                                {{ old('hisapan_bayi') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('hisapan_bayi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pemberian_makan">Pemberian Makan</label>
                                        <select class="form-control @error('pemberian_makan') is-invalid @enderror"
                                            name="pemberian_makan" id="pemberian_makan">
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="Ya"
                                                {{ old('pemberian_makan') == 'Ya' ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="Tidak"
                                                {{ old('pemberian_makan') == 'Tidak' ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                        @error('pemberian_makan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="margin-top: 2%">
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengingat_periksa_postu">Mengingatkan Periksa Ke Postu/Fasyankes</label>
                                    <input type="text"
                                        class="form-control @error('pengingat_periksa_postu') is-invalid @enderror"
                                        name="pengingat_periksa_postu" id="pengingat_periksa_postu"
                                        placeholder="Mengingatkan Periksa Ke Postu/Fasyankes"
                                        value="{{ old('pengingat_periksa_postu') }}" required>
                                    @error('pengingat_periksa_postu')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lapor_nakes">Tanggal Lapor Nakes</label>
                                    <input type="date" class="form-control @error('lapor_nakes') is-invalid @enderror"
                                        name="lapor_nakes" id="lapor_nakes" value="{{ old('lapor_nakes') }}" required>
                                    @error('lapor_nakes')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary" onclick="setAction('save')">Simpan</button>
                        <a href="{{ route('kunjungan_rumah_bayi.index') }}" class="btn btn-default">Kembali Ke List</a>
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
                'tgl_lahir': document.getElementById('tgl_lahir'),
                'tmp_lahir': document.getElementById('tmp_lahir'),
                'gender': document.getElementById('gender'),
                'kunjungan': document.getElementById('kunjungan'),
                'tgl_kunjungan': document.getElementById('tgl_kunjungan'),
                'suhu_tubuh': document.getElementById('suhu_tubuh'),
                'buku_kia': document.getElementById('buku_kia'),
                'tgl_timbang_ukur': document.getElementById('tgl_timbang_ukur'),
                'tempat_timbang_ukur': document.getElementById('tempat_timbang_ukur'),
                'petugas_timbang_ukur': document.getElementById('petugas_timbang_ukur'),
                'bb_hasil_timbang_ukur': document.getElementById('bb_hasil_timbang_ukur'),
                'pb_tb_hasil_timbang_ukur': document.getElementById('pb_tb_hasil_timbang_ukur'),
                'lk_hasil_timbang_ukur': document.getElementById('lk_hasil_timbang_ukur'),
                // 'jenis_imunisasi': document.getElementById('jenis_imunisasi'),
                // 'hepatitis_b_0bulan': document.getElementById('hepatitis_b_0bulan'),
                // 'bcg_0bulan': document.getElementById('bcg_0bulan'),
                // 'polio_0bulan': document.getElementById('polio_0bulan'),
                // 'bcg_1bulan': document.getElementById('bcg_1bulan'),
                // 'polio_1bulan': document.getElementById('polio_1bulan'),
                // 'dpt_hb_hib_1_2bulan': document.getElementById('dpt_hb_hib_1_2bulan'),
                // 'polio_2_2bulan': document.getElementById('polio_2_2bulan'),
                // 'pcv_1_2bulan': document.getElementById('pcv_1_2bulan'),
                // 'rv_1_2bulan': document.getElementById('rv_1_2bulan'),
                // 'dpt_hb_hib_2_3bulan': document.getElementById('dpt_hb_hib_2_3bulan'),
                // 'polio_3_3bulan': document.getElementById('polio_3_3bulan'),
                // 'pcv_2_3bulan': document.getElementById('pcv_2_3bulan'),
                // 'rv_2_3bulan': document.getElementById('rv_2_3bulan'),
                // 'dpt_hb_hib_3_4bulan': document.getElementById('dpt_hb_hib_3_4bulan'),
                // 'polio_4_4bulan': document.getElementById('polio_4_4bulan'),
                // 'polio_suntik_4bulan': document.getElementById('polio_suntik_4bulan'),
                // 'rv_3_4bulan': document.getElementById('rv_3_4bulan'),
                // 'campak_rubelia_9bulan': document.getElementById('campak_rubelia_9bulan'),
                // 'polio_suntik_2_9bulan': document.getElementById('polio_suntik_2_9bulan'),
                // 'je_10bulan': document.getElementById('je_10bulan'),
                // 'pv_3_12bulan': document.getElementById('pv_3_12bulan'),
                // 'dpt_lanjut_1_18bulan': document.getElementById('dpt_lanjut_1_18bulan'),
                // 'campak_lanjut_18bulan': document.getElementById('campak_lanjut_18bulan'),


            };

            // Memeriksa jika ada data tersimpan di local storage
            for (var key in fields) {
                var storedValue = localStorage.getItem(key);
                if (storedValue !== null) {
                    fields[key].value = storedValue;
                }
            }

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
                        fields[key].value = ''; // Clear value if status is 'Tidak'
                    } else if (fields[key].value.trim() === '') {
                        fields[key].value = ''; // Clear field if status is 'Ya'
                    }
                }
            }

            statusSelect.addEventListener('change', function() {
                toggleFormFields(statusSelect.value);
            });

            // Initial check
            toggleFormFields(statusSelect.value);

            // Simpan nilai input ke local storage saat nilai diubah
            for (var key in fields) {
                fields[key].addEventListener('input', function(event) {
                    localStorage.setItem(event.target.id, event.target.value);
                });
            }

            // Hapus data local storage saat form disubmit
            var form = document.getElementById('modal-save-form');
            form.addEventListener('submit', function() {
                for (var key in fields) {
                    localStorage.removeItem(key);
                }
            });
        });
        // ===================================================================================
        document.addEventListener("DOMContentLoaded", function() {
            var statusSelect = document.getElementById('status');
            var fields = {
                // 'pb_tb_hasil_timbang_ukur': document.getElementById('pb_tb_hasil_timbang_ukur'),
                // 'lk_hasil_timbang_ukur': document.getElementById('lk_hasil_timbang_ukur'),
                // 'jenis_imunisasi': document.getElementById('jenis_imunisasi'),
                'hepatitis_b_0bulan': document.getElementById('hepatitis_b_0bulan'),
                'bcg_0bulan': document.getElementById('bcg_0bulan'),
                'polio_0bulan': document.getElementById('polio_0bulan'),
                'bcg_1bulan': document.getElementById('bcg_1bulan'),
                'polio_1bulan': document.getElementById('polio_1bulan'),
                'dpt_hb_hib_1_2bulan': document.getElementById('dpt_hb_hib_1_2bulan'),
                'polio_2_2bulan': document.getElementById('polio_2_2bulan'),
                'pcv_1_2bulan': document.getElementById('pcv_1_2bulan'),
                'rv_1_2bulan': document.getElementById('rv_1_2bulan'),
                'dpt_hb_hib_2_3bulan': document.getElementById('dpt_hb_hib_2_3bulan'),
                'polio_3_3bulan': document.getElementById('polio_3_3bulan'),
                'pcv_2_3bulan': document.getElementById('pcv_2_3bulan'),
                'rv_2_3bulan': document.getElementById('rv_2_3bulan'),
                'dpt_hb_hib_3_4bulan': document.getElementById('dpt_hb_hib_3_4bulan'),
                'polio_4_4bulan': document.getElementById('polio_4_4bulan'),
                'polio_suntik_4bulan': document.getElementById('polio_suntik_4bulan'),
                'rv_3_4bulan': document.getElementById('rv_3_4bulan'),
                'campak_rubelia_9bulan': document.getElementById('campak_rubelia_9bulan'),
                'polio_suntik_2_9bulan': document.getElementById('polio_suntik_2_9bulan'),
                'je_10bulan': document.getElementById('je_10bulan'),
                'pv_3_12bulan': document.getElementById('pv_3_12bulan'),
                'dpt_lanjut_1_18bulan': document.getElementById('dpt_lanjut_1_18bulan'),
                'campak_lanjut_18bulan': document.getElementById('campak_lanjut_18bulan'),
                'makanan_pokok': document.getElementById('makanan_pokok'),
                'makanan_protein_hewan': document.getElementById('makanan_protein_hewan'),
                'makanan_protein_nabati': document.getElementById('makanan_protein_nabati'),
                'makanan_lemak': document.getElementById('makanan_lemak'),
                'sayur_buah': document.getElementById('sayur_buah'),
                'oc_ada': document.getElementById('oc_ada'),
                'oc_tgl': document.getElementById('oc_tgl'),
                'kv_jenis': document.getElementById('kv_jenis'),
                'tgl_kv_mulai': document.getElementById('tgl_kv_mulai'),
                'tgl_kv_selesai': document.getElementById('tgl_kv_selesai'),
                'makan_tambah_ada': document.getElementById('makan_tambah_ada'),
                'makan_tambah_kepatuhan': document.getElementById('makan_tambah_kepatuhan'),
                'edukasi': document.getElementById('edukasi'),
                'napas': document.getElementById('napas'),
                'batuk': document.getElementById('batuk'),
                'diare': document.getElementById('diare'),
                'jmh_warna_kencing': document.getElementById('jmh_warna_kencing'),
                'warna_kulit': document.getElementById('warna_kulit'),
                'aktifitas': document.getElementById('aktifitas'),
                'hisapan_bayi': document.getElementById('hisapan_bayi'),
                'pemberian_makan': document.getElementById('pemberian_makan'),
                'pengingat_periksa_postu': document.getElementById('pengingat_periksa_postu'),
                'lapor_nakes': document.getElementById('lapor_nakes')
            };

            // Memeriksa jika ada data tersimpan di local storage
            for (var key in fields) {
                var storedValue = localStorage.getItem(key);
                if (storedValue !== null) {
                    fields[key].value = storedValue;
                }
            }

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
                        fields[key].value = ''; // Clear value if status is 'Tidak'
                    } else if (fields[key].value.trim() === '') {
                        fields[key].value = ''; // Clear field if status is 'Ya'
                    }
                }
            }

            statusSelect.addEventListener('change', function() {
                toggleFormFields(statusSelect.value);
            });

            // Initial check
            toggleFormFields(statusSelect.value);

            // Simpan nilai input ke local storage saat nilai diubah
            for (var key in fields) {
                fields[key].addEventListener('input', function(event) {
                    localStorage.setItem(event.target.id, event.target.value);
                });
            }

            // Hapus data local storage saat form disubmit
            var form = document.getElementById('modal-save-form');
            form.addEventListener('submit', function() {
                for (var key in fields) {
                    localStorage.removeItem(key);
                }
            });
        });

        // ===================================================================================

        // var jenisImunisasiSelect = document.getElementById('jenis_imunisasi');
        // var fieldsByImunisasi = {
        //     'Usia 0 Bulan': ['hepatitis_b_0bulan', 'bcg_0bulan', 'polio_0bulan'],
        //     'Usia 1 Bulan': ['bcg_1bulan', 'polio_1bulan'],
        //     'Usia 2 Bulan': ['dpt_hb_hib_1_2bulan', 'polio_2_2bulan', 'pcv_1_2bulan', 'rv_1_2bulan'],
        //     'Usia 3 Bulan': ['dpt_hb_hib_2_3bulan', 'polio_3_3bulan', 'pcv_2_3bulan', 'rv_2_3bulan'],
        //     'Usia 4 Bulan': ['dpt_hb_hib_3_4bulan', 'polio_4_4bulan', 'polio_suntik_4bulan', 'rv_3_4bulan'],
        //     'Usia 9 Bulan': ['campak_rubelia_9bulan', 'polio_suntik_2_9bulan'],
        //     'Usia 10 Bulan': ['je_10bulan'],
        //     'Usia 12 Bulan': ['pv_3_12bulan'],
        //     'Usia 18 Bulan': ['dpt_lanjut_1_18bulan', 'campak_lanjut_18bulan']
        // };

        // function updateFormFields() {
        //     var selectedImunisasi = jenisImunisasiSelect.value;
        //     var allFields = document.querySelectorAll(
        //         '[id^=hepatitis_b_0bulan], [id^=bcg_0bulan], [id^=polio_0bulan], ' +
        //         '[id^=bcg_1bulan], [id^=polio_1bulan], [id^=dpt_hb_hib_1_2bln], ' +
        //         '[id^=polio_2_2bulan], [id^=pcv_1_2bulan], [id^=rv_1_2bulan], ' +
        //         '[id^=dpt_hb_hib_2_3bulan], [id^=polio_3_3bulan], [id^=pcv_2_3bulan], ' +
        //         '[id^=rv_2_3bulan], [id^=dpt_hb_hib_3_4bulan], [id^=polio_4_4bulan], ' +
        //         '[id^=polio_suntik_4bulan], [id^=rv_3_4bulan], [id^=campak_rubelia_9bulan], ' +
        //         '[id^=polio_suntik_2_9bulan], [id^=je_10bulan], [id^=pv_3_12bulan], ' +
        //         '[id^=dpt_lanjut_1_18bulan], [id^=campak_lanjut_18bulan],[id^=dpt_hb_hib_1_2bulan]'
        //     );


        //     // Mengatur keterlihatan formulir berdasarkan pilihan imunisasi
        //     // Mengatur keterlihatan formulir berdasarkan pilihan imunisasi
        //     allFields.forEach(function(field) {
        //         if (fieldsByImunisasi[selectedImunisasi] && fieldsByImunisasi[selectedImunisasi].includes(field
        //                 .id)) {
        //             field.closest('.form-group').style.display = 'block';
        //             field.required = true;

        //             if (field.value === 'Ya') {
        //                 localStorage.setItem(field.id,
        //                     'Ya'); // Menyimpan nilai "Ya" ke local storage jika formulir aktif
        //             } else {
        //                 field.value = 'Ya'; // Langsung memilih value "Ya" pada formulir yang aktif
        //             }
        //         } else {
        //             field.closest('.form-group').style.display = 'none';
        //             field.required = false;

        //             if (field.value === 'Tidak') {
        //                 localStorage.setItem(field.id,
        //                     'Tidak'); // Menyimpan nilai "Tidak" ke local storage jika formulir tidak aktif
        //             } else {
        //                 field.value = 'Tidak'; // Langsung memilih value "Tidak" pada formulir yang tidak aktif
        //             }
        //         }
        //     });
        // }

        // Memanggil fungsi untuk memperbarui status formulir saat halaman dimuat dan setiap kali dropdown diubah
        // document.addEventListener('DOMContentLoaded', function() {
        //     updateFormFields();
        //     jenisImunisasiSelect.addEventListener('change', updateFormFields);
        // });

        document.getElementById('btnCekData').addEventListener('click', function() {
            var nik = document.getElementById('nik').value;

            Swal.fire({
                title: 'Checking...',
                text: 'Please wait while we check the data.',
                imageUrl: 'https://media.tenor.com/y6-Oq1X_9NcAAAAC/loading-loading-gif.gif',
                imageWidth: 100,
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });

            fetch('{{ route('kunjungan_rumah_bayi.checkKK') }}', {
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
                        text: 'There was an error checking the NIK.'
                    });
                    console.error('Error:', error);
                });
        });

        document.getElementById('modal-save-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah submit default

            Swal.fire({
                title: 'Saving...',
                text: 'Please wait while we save your data.',
                imageUrl: 'https://media.tenor.com/y6-Oq1X_9NcAAAAC/loading-loading-gif.gif',
                imageWidth: 100,
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });

            // Submit form setelah menampilkan animasi loading
            this.submit();
        });
    </script>


    <style>
        .card {
            text-align: center
        }
    </style>
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
