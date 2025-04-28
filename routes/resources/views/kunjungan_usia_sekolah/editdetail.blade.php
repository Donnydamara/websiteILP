@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Update kunjungan Usia Sekolah') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">

            <form action="{{ route('kunjungan_usia_sekolah.updatedetail', ['id' => $kunjunganusiaSekolah->id]) }}"
                method="post" id="modal-save-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">Status Kunjungan Usia Sekolah</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" required>
                        <option value="">Pilih</option>
                        <option value="Ya"
                            {{ old('status') ?? $kunjunganusiaSekolah->status === 'Ya' ? 'selected' : '' }}>Ya
                        </option>
                        <option value="Tidak"
                            {{ old('status') ?? $kunjunganusiaSekolah->status === 'Tidak' ? 'selected' : '' }}>
                            Tidak</option>
                        <option value="Selesai"
                            {{ old('status') ?? $kunjunganusiaSekolah->status === 'Selesai' ? 'selected' : '' }}>
                            Selesai</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="card">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kk">Kartu Keluarga</label>
                                <input type="number" class="form-control @error('kk') is-invalid @enderror" name="kk"
                                    id="kk" placeholder="Kartu Keluarga" autocomplete="off"
                                    value="{{ old('kk') ?? $kunjunganusiaSekolah->kk }}" required readonly>
                                @error('kk')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" placeholder="Nama" autocomplete="off"
                                    value="{{ old('nama') ?? $kunjunganusiaSekolah->nama }}" required readonly>
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                    id="nik" placeholder="NIK" autocomplete="off"
                                    value="{{ old('nik') ?? $kunjunganusiaSekolah->nik }}" required readonly>
                                @error('nik')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                    name="tgl_lahir" id="tgl_lahir" autocomplete="off"
                                    value="{{ old('tgl_lahir') ?? $kunjunganusiaSekolah->tgl_lahir }}" required>
                                @error('tgl_lahir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tmp_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control @error('tmp_lahir') is-invalid @enderror"
                                    name="tmp_lahir" id="tmp_lahir" placeholder="Tempat Lahir"
                                    autocomplete="off"value="{{ old('tmp_lahir') ?? $kunjunganusiaSekolah->tmp_lahir }}"
                                    required>
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
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="Laki-laki"
                                        {{ (old('gender') ?? $kunjunganusiaSekolah->gender) == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Wanita"
                                        {{ (old('gender') ?? $kunjunganusiaSekolah->gender) == 'Wanita' ? 'selected' : '' }}>
                                        Wanita</option>
                                </select>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kunjungan">Kunjungan</label>
                                <input type="number" class="form-control @error('kunjungan') is-invalid @enderror"
                                    name="kunjungan" id="kunjungan" placeholder="Kunjungan" autocomplete="off"
                                    value="{{ old('kunjungan') ?? $kunjunganusiaSekolah->kunjungan }}" required>
                                @error('kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_kunjungan">Tanggal</label>
                                <input type="date" class="form-control @error('tgl_kunjungan') is-invalid @enderror"
                                    name="tgl_kunjungan" id="tgl_kunjungan" autocomplete="off"
                                    value="{{ old('tgl_kunjungan') ?? $kunjunganusiaSekolah->tgl_kunjungan }}" required>
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
                                    <option value="" disabled selected>Pilih Suhu Tubuh</option>
                                    <option value="<37,5°C"
                                        {{ (old('suhu_tubuh') ?? $kunjunganusiaSekolah->suhu_tubuh) == '<37,5°C' ? 'selected' : '' }}>
                                        &lt;37,5°C</option>
                                    <option value=">37,5°C"
                                        {{ (old('suhu_tubuh') ?? $kunjunganusiaSekolah->suhu_tubuh) == '>37,5°C' ? 'selected' : '' }}>
                                        &gt;37,5°C</option>
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
                                <h5>Tanggal Terakhir Menimbang Dan Mengukur</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_timbang_ukur">Tanggal</label>
                                <input type="date"
                                    class="form-control @error('tgl_timbang_ukur') is-invalid @enderror"
                                    name="tgl_timbang_ukur" id="tgl_timbang_ukur" autocomplete="off"
                                    value="{{ old('tgl_timbang_ukur') ?? $kunjunganusiaSekolah->tgl_timbang_ukur }}"
                                    required>
                                @error('tgl_timbang_ukur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tmp_timbang_ukur">Tempat</label>
                                <select class="form-control @error('tmp_timbang_ukur') is-invalid @enderror"
                                    name="tmp_timbang_ukur" id="tmp_timbang_ukur" required>
                                    <option value="" disabled selected>Pilih Tempat</option>
                                    <option value="Sekolah"
                                        {{ (old('tmp_timbang_ukur') ?? $kunjunganusiaSekolah->tmp_timbang_ukur) == 'Sekolah' ? 'selected' : '' }}>
                                        Sekolah</option>
                                    <option value="Posyandu"
                                        {{ (old('tmp_timbang_ukur') ?? $kunjunganusiaSekolah->tmp_timbang_ukur) == 'Posyandu' ? 'selected' : '' }}>
                                        Posyandu</option>
                                    <option value="Rumah"
                                        {{ (old('tmp_timbang_ukur') ?? $kunjunganusiaSekolah->tmp_timbang_ukur) == 'Rumah' ? 'selected' : '' }}>
                                        Rumah</option>
                                </select>
                                @error('tmp_timbang_ukur')
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
                                <label for="porsi">Porsi</label>
                                <select class="form-control @error('porsi') is-invalid @enderror" name="porsi"
                                    id="porsi" required>
                                    <option value="" disabled selected>Pilih Porsi</option>
                                    <option value="Ya"
                                        {{ (old('porsi') ?? $kunjunganusiaSekolah->porsi) == 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('porsi') ?? $kunjunganusiaSekolah->porsi) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('porsi')
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
                                <label for="bb_timbang_ukur">BB</label>
                                <input type="number" class="form-control @error('bb_timbang_ukur') is-invalid @enderror"
                                    name="bb_timbang_ukur" id="bb_timbang_ukur" placeholder="Berat Badan"
                                    autocomplete="off"
                                    value="{{ old('bb_timbang_ukur') ?? $kunjunganusiaSekolah->bb_timbang_ukur }}"
                                    required>
                                @error('bb_timbang_ukur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tb_timbang_ukur">TB</label>
                                <input type="number" class="form-control @error('tb_timbang_ukur') is-invalid @enderror"
                                    name="tb_timbang_ukur" id="tb_timbang_ukur" placeholder="Tinggi Badan"
                                    autocomplete="off"
                                    value="{{ old('tb_timbang_ukur') ?? $kunjunganusiaSekolah->tb_timbang_ukur }}"
                                    required>
                                @error('tb_timbang_ukur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lp_timbang_ukur">LP</label>
                                <input type="number" class="form-control @error('lp_timbang_ukur') is-invalid @enderror"
                                    name="lp_timbang_ukur" id="lp_timbang_ukur" placeholder="Lingkar Kepala"
                                    autocomplete="off"
                                    value="{{ old('lp_timbang_ukur') ?? $kunjunganusiaSekolah->lp_timbang_ukur }}"
                                    required>
                                @error('lp_timbang_ukur')
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
                                <h5>Remaja Putri</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ada_ttd_putri">Ada</label>
                                <select class="form-control @error('ada_ttd_putri') is-invalid @enderror"
                                    name="ada_ttd_putri" id="ada_ttd_putri">
                                    <option value="" disabled selected>Pilih Opsi</option>
                                    <option value="Ya"
                                        {{ (old('ada_ttd_putri') ?? $kunjunganusiaSekolah->ada_ttd_putri) == 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('ada_ttd_putri') ?? $kunjunganusiaSekolah->ada_ttd_putri) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('ada_ttd_putri')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="minum_ttd_putri">Minum TTD Minggu Ini/ Dalam 7 Hari Terakhir</label>
                                <select class="form-control @error('minum_ttd_putri') is-invalid @enderror"
                                    name="minum_ttd_putri" id="minum_ttd_putri">
                                    <option value="" disabled selected>Pilih Opsi</option>
                                    <option value="Ya"
                                        {{ (old('minum_ttd_putri') ?? $kunjunganusiaSekolah->minum_ttd_putri) == 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('minum_ttd_putri') ?? $kunjunganusiaSekolah->minum_ttd_putri) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('minum_ttd_putri')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Pemeriksaan Anemia (Skrining Hb) Satu Tahub Sekali</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_skrining_hb_putri">Tanggal</label>
                                <input type="date"
                                    class="form-control @error('tgl_skrining_hb_putri') is-invalid @enderror"
                                    name="tgl_skrining_hb_putri" id="tgl_skrining_hb_putri" autocomplete="off"
                                    value="{{ old('tgl_skrining_hb_putri') ?? $kunjunganusiaSekolah->tgl_skrining_hb_putri }}">
                                @error('tgl_skrining_hb_putri')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tmp_skrining_hb_putri">Tempat</label>
                                <select class="form-control @error('tmp_skrining_hb_putri') is-invalid @enderror"
                                    name="tmp_skrining_hb_putri" id="tmp_skrining_hb_putri">
                                    <option value="" disabled selected>Pilih Tempat</option>
                                    <option value="Sekolah"
                                        {{ (old('tmp_skrining_hb_putri') ?? $kunjunganusiaSekolah->tmp_skrining_hb_putri) == 'Sekolah' ? 'selected' : '' }}>
                                        Sekolah</option>
                                    <option value="Posyandu"
                                        {{ (old('tmp_skrining_hb_putri') ?? $kunjunganusiaSekolah->tmp_skrining_hb_putri) == 'Posyandu' ? 'selected' : '' }}>
                                        Posyandu</option>
                                    <option value="Rumah"
                                        {{ (old('tmp_skrining_hb_putri') ?? $kunjunganusiaSekolah->tmp_skrining_hb_putri) == 'Rumah' ? 'selected' : '' }}>
                                        Rumah</option>
                                </select>
                                @error('tmp_skrining_hb_putri')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hasil_skrining_hb_putri">Hasil</label>
                                <input type="number"
                                    class="form-control @error('hasil_skrining_hb_putri') is-invalid @enderror"
                                    name="hasil_skrining_hb_putri" id="hasil_skrining_hb_putri" placeholder="Hasil"
                                    autocomplete="off"
                                    value="{{ old('hasil_skrining_hb_putri') ?? $kunjunganusiaSekolah->hasil_skrining_hb_putri }}">
                                @error('hasil_skrining_hb_putri')
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
                                <label for="merokok">Perilaku Merokok</label>
                                <select class="form-control @error('merokok') is-invalid @enderror" name="merokok"
                                    id="merokok" required>
                                    <option value="" disabled selected>Pilih Opsi</option>
                                    <option value="Ya"
                                        {{ (old('merokok') ?? $kunjunganusiaSekolah->merokok) == 'Aktif' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="Tidak"
                                        {{ (old('merokok') ?? $kunjunganusiaSekolah->merokok) == 'Pasif' ? 'selected' : '' }}>
                                        Pasif</option>
                                </select>
                                @error('merokok')
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
                                <h5>Remaja >15 Tahun Periksaan PTM*) Satu Tahun Terakhir</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 2%">
                        <div class="row" style="margin: 1%">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Gula Darah</h5>
                                </div>
                            </div>

                            <div class="row" style="margin: 1%">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tgl_gula_darah_periksi_ptm">Tanggal</label>
                                        <input type="date"
                                            class="form-control @error('tgl_gula_darah_periksi_ptm') is-invalid @enderror"
                                            name="tgl_gula_darah_periksi_ptm" id="tgl_gula_darah_periksi_ptm"
                                            autocomplete="off"
                                            value="{{ old('tgl_gula_darah_periksi_ptm') ?? $kunjunganusiaSekolah->tgl_gula_darah_periksi_ptm }}"
                                            required>
                                        @error('tgl_gula_darah_periksi_ptm')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tmp_gula_darah_periksi_ptm">Tempat</label>
                                        <select
                                            class="form-control @error('tmp_gula_darah_periksi_ptm') is-invalid @enderror"
                                            name="tmp_gula_darah_periksi_ptm" id="tmp_gula_darah_periksi_ptm" required>
                                            <option value="" disabled selected>Pilih Tempat</option>
                                            <option value="Sekolah"
                                                {{ (old('tmp_gula_darah_periksi_ptm') ?? $kunjunganusiaSekolah->tmp_gula_darah_periksi_ptm) == 'Sekolah' ? 'selected' : '' }}>
                                                Sekolah</option>
                                            <option value="Posyandu"
                                                {{ (old('tmp_gula_darah_periksi_ptm') ?? $kunjunganusiaSekolah->tmp_gula_darah_periksi_ptm) == 'Posyandu' ? 'selected' : '' }}>
                                                Posyandu</option>
                                            <option value="Rumah"
                                                {{ (old('tmp_gula_darah_periksi_ptm') ?? $kunjunganusiaSekolah->tmp_gula_darah_periksi_ptm) == 'Rumah' ? 'selected' : '' }}>
                                                Rumah</option>
                                        </select>
                                        @error('tmp_gula_darah_periksi_ptm')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hasil_gula_darah_periksi_ptm">Hasil</label>
                                        <input type="number"
                                            class="form-control @error('hasil_gula_darah_periksi_ptm') is-invalid @enderror"
                                            name="hasil_gula_darah_periksi_ptm" id="hasil_gula_darah_periksi_ptm"
                                            placeholder="Hasil" autocomplete="off"
                                            value="{{ old('hasil_gula_darah_periksi_ptm') ?? $kunjunganusiaSekolah->hasil_gula_darah_periksi_ptm }}"
                                            required>
                                        @error('hasil_gula_darah_periksi_ptm')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 2%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Tekanan Darah</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tmp_tekanan_darah_periksi_ptm">Tempat</label>
                                <select class="form-control @error('tmp_tekanan_darah_periksi_ptm') is-invalid @enderror"
                                    name="tmp_tekanan_darah_periksi_ptm" id="tmp_tekanan_darah_periksi_ptm" required>
                                    <option value="" disabled selected>Pilih Tempat</option>
                                    <option value="Sekolah"
                                        {{ (old('tmp_tekanan_darah_periksi_ptm') ?? $kunjunganusiaSekolah->tmp_tekanan_darah_periksi_ptm) == 'Sekolah' ? 'selected' : '' }}>
                                        Sekolah</option>
                                    <option value="Posyandu"
                                        {{ (old('tmp_tekanan_darah_periksi_ptm') ?? $kunjunganusiaSekolah->tmp_tekanan_darah_periksi_ptm) == 'Posyandu' ? 'selected' : '' }}>
                                        Posyandu</option>
                                    <option value="Rumah"
                                        {{ (old('tmp_tekanan_darah_periksi_ptm') ?? $kunjunganusiaSekolah->tmp_tekanan_darah_periksi_ptm) == 'Rumah' ? 'selected' : '' }}>
                                        Rumah</option>
                                </select>
                                @error('tmp_tekanan_darah_periksi_ptm')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_tekanan_darah_periksi_ptm">Tanggal</label>
                                <input type="date"
                                    class="form-control @error('tgl_tekanan_darah_periksi_ptm') is-invalid @enderror"
                                    name="tgl_tekanan_darah_periksi_ptm" id="tgl_tekanan_darah_periksi_ptm"
                                    autocomplete="off"
                                    value="{{ old('tgl_tekanan_darah_periksi_ptm') ?? $kunjunganusiaSekolah->tgl_tekanan_darah_periksi_ptm }}"
                                    required>
                                @error('tgl_tekanan_darah_periksi_ptm')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hasil_tekanan_darah_periksi_ptm">Hasil</label>
                                <input type="number"
                                    class="form-control @error('hasil_tekanan_darah_periksi_ptm') is-invalid @enderror"
                                    name="hasil_tekanan_darah_periksi_ptm" id="hasil_tekanan_darah_periksi_ptm"
                                    placeholder="Hasil" autocomplete="off"
                                    value="{{ old('hasil_tekanan_darah_periksi_ptm') ?? $kunjunganusiaSekolah->hasil_tekanan_darah_periksi_ptm }}"
                                    required>
                                @error('hasil_tekanan_darah_periksi_ptm')
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
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_skrining">Tanggal</label>
                                <input type="date" class="form-control @error('tgl_skrining') is-invalid @enderror"
                                    name="tgl_skrining" id="tgl_skrining" autocomplete="off"
                                    value="{{ old('tgl_skrining') ?? $kunjunganusiaSekolah->tgl_skrining }}" required>
                                @error('tgl_skrining')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tmp_skrining">Tempat</label>
                                <select class="form-control @error('tmp_skrining') is-invalid @enderror"
                                    name="tmp_skrining" id="tmp_skrining" required>
                                    <option value="" disabled selected>Pilih Tempat</option>
                                    <option value="Sekolah"
                                        {{ (old('tmp_skrining') ?? $kunjunganusiaSekolah->tmp_skrining) == 'Sekolah' ? 'selected' : '' }}>
                                        Sekolah</option>
                                    <option value="Posyandu"
                                        {{ (old('tmp_skrining') ?? $kunjunganusiaSekolah->tmp_skrining) == 'Posyandu' ? 'selected' : '' }}>
                                        Posyandu</option>
                                    <option value="Rumah"
                                        {{ (old('tmp_skrining') ?? $kunjunganusiaSekolah->tmp_skrining) == 'Rumah' ? 'selected' : '' }}>
                                        Rumah</option>
                                </select>
                                @error('tmp_skrining')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="petugas_skrining">Petugas Skrining</label>
                                <input type="text"
                                    class="form-control @error('petugas_skrining') is-invalid @enderror"
                                    name="petugas_skrining" id="petugas_skrining" placeholder="Petugas Skrining"
                                    autocomplete="off"
                                    value="{{ old('petugas_skrining') ?? $kunjunganusiaSekolah->petugas_skrining }}"
                                    required>
                                @error('petugas_skrining')
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
                                <label for="edukasi">Pemberian Edukasi/Kunjungan Nakes</label>
                                <input type="text" class="form-control @error('edukasi') is-invalid @enderror"
                                    name="edukasi" id="edukasi" placeholder="Edukasi" autocomplete="off"
                                    value="{{ old('edukasi') ?? $kunjunganusiaSekolah->edukasi }}">
                                @error('edukasi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary" onclick="setAction('save')">Simpan</button>
                    <button class="btn btn-default" onclick="history.back()">Kembali Ke List</button>
                </div>

            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var statusSelect = document.getElementById('status');
            var genderSelect = document.getElementById('gender');
            var form = document.getElementById('modal-save-form');

            var fields = {
                'tgl_lahir': document.getElementById('tgl_lahir'),
                'tmp_lahir': document.getElementById('tmp_lahir'),
                'gender': genderSelect,
                'kunjungan': document.getElementById('kunjungan'),
                'tgl_kunjungan': document.getElementById('tgl_kunjungan'),
                'suhu_tubuh': document.getElementById('suhu_tubuh'),
                'tgl_timbang_ukur': document.getElementById('tgl_timbang_ukur'),
                'tempat_timbang_ukur': document.getElementById('tmp_timbang_ukur'),
                'porsi': document.getElementById('porsi'),
                'bb_timbang_ukur': document.getElementById('bb_timbang_ukur'),
                'tb_timbang_ukur': document.getElementById('tb_timbang_ukur'),
                'lp_timbang_ukur': document.getElementById('lp_timbang_ukur'),
                'ada_ttd_putri': document.getElementById('ada_ttd_putri'),
                'minum_ttd_putri': document.getElementById('minum_ttd_putri'),
                'tgl_skrining_hb_putri': document.getElementById('tgl_skrining_hb_putri'),
                'tmp_skrining_hb_putri': document.getElementById('tmp_skrining_hb_putri'),
                'hasil_skrining_hb_putri': document.getElementById('hasil_skrining_hb_putri'),
                'merokok': document.getElementById('merokok'),
                'tgl_gula_darah_periksi_ptm': document.getElementById('tgl_gula_darah_periksi_ptm'),
                'tmp_gula_darah_periksi_ptm': document.getElementById('tmp_gula_darah_periksi_ptm'),
                'hasil_gula_darah_periksi_ptm': document.getElementById('hasil_gula_darah_periksi_ptm'),
                'tgl_tekanan_darah_periksi_ptm': document.getElementById('tgl_tekanan_darah_periksi_ptm'),
                'tmp_tekanan_darah_periksi_ptm': document.getElementById('tmp_tekanan_darah_periksi_ptm'),
                'hasil_tekanan_darah_periksi_ptm': document.getElementById('hasil_tekanan_darah_periksi_ptm'),
                'tgl_skrining': document.getElementById('tgl_skrining'),
                'tmp_skrining': document.getElementById('tmp_skrining'),
                'petugas_skrining': document.getElementById('petugas_skrining'),
                'edukasi': document.getElementById('edukasi')
            };

            // Load saved values from localStorage
            for (var key in fields) {
                var storedValue = localStorage.getItem(key);
                if (storedValue !== null) {
                    fields[key].value = storedValue;
                }
            }

            // Set initial status select value
            var oldStatusValue = "{{ old('status') }}";
            if (oldStatusValue !== '') {
                statusSelect.value = oldStatusValue;
            }

            function toggleFormFields(status) {
                var isActive = status === 'Ya' || status === 'Selesai';
                for (var key in fields) {
                    fields[key].required = isActive;
                    fields[key].disabled = !isActive;
                    if (!isActive) {
                        fields[key].value = ''; // Clear value if status is 'Tidak'
                    }
                }
            }

            statusSelect.addEventListener('change', function() {
                toggleFormFields(statusSelect.value);
            });

            // Initial status check
            toggleFormFields(statusSelect.value);

            // Save input values to localStorage on change
            for (var key in fields) {
                fields[key].addEventListener('input', function(event) {
                    localStorage.setItem(event.target.id, event.target.value);
                });
            }

            // Gender-specific logic
            function resetFormInputs() {
                fields['ada_ttd_putri'].value = '';
                fields['minum_ttd_putri'].value = '';
                fields['tgl_skrining_hb_putri'].value = '';
                fields['tmp_skrining_hb_putri'].value = '';
                fields['hasil_skrining_hb_putri'].value = '';
            }

            function toggleGenderSpecificFields() {
                var isFemale = genderSelect.value === 'Wanita';
                var femaleFields = ['ada_ttd_putri', 'minum_ttd_putri', 'tgl_skrining_hb_putri',
                    'tmp_skrining_hb_putri', 'hasil_skrining_hb_putri'
                ];

                femaleFields.forEach(function(key) {
                    if (isFemale) {
                        fields[key].removeAttribute('disabled');
                    } else {
                        fields[key].setAttribute('disabled', 'disabled');
                        fields[key].value = ''; // Clear value if gender is not 'Wanita'
                    }
                });
            }

            genderSelect.addEventListener('change', toggleGenderSpecificFields);

            // Initial gender check
            toggleGenderSpecificFields();

            // Clear localStorage on form submit
            form.addEventListener('submit', function() {
                for (var key in fields) {
                    localStorage.removeItem(key);
                }
            });
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
