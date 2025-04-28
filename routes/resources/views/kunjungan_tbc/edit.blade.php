@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Update Kunjungan TBC') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">

            <form action="{{ route('kunjungan_tbc.update', ['id' => $kunjunganTBC->id]) }}" method="post"
                id="modal-save-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">Status Kunjungan TBC</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" required>
                        <option value="">Pilih</option>
                        <option value="Ya" {{ old('status') ?? $kunjunganTBC->status === 'Ya' ? 'selected' : '' }}>Ya
                        </option>
                        <option value="Tidak" {{ old('status') ?? $kunjunganTBC->status === 'Tidak' ? 'selected' : '' }}>
                            Tidak</option>
                        <option value="Selesai"
                            {{ old('status') ?? $kunjunganTBC->status === 'Selesai' ? 'selected' : '' }}>
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
                                    id="kk" placeholder="KK" autocomplete="off"
                                    value="{{ old('kk') ?? $kunjunganTBC->kk }}" required readonly>
                                @error('kk')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Ulangi pola yang sama untuk setiap field -->
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" placeholder="Nama" autocomplete="off"
                                    value="{{ old('nama') ?? $kunjunganTBC->nama }}" required readonly>
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
                                    value="{{ old('nik') ?? $kunjunganTBC->nik }}" required readonly>
                                @error('nik')
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
                                    name="tgl_lahir" id="tgl_lahir" autocomplete="off"
                                    value="{{ old('tgl_lahir') ?? $kunjunganTBC->tgl_lahir }}" required>
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
                                    autocomplete="off"value="{{ old('tmp_lahir') ?? $kunjunganTBC->tmp_lahir }}" required>
                                @error('tmp_lahir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" name="gender"
                                        id="gender" required>
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki"
                                            {{ (old('gender') ?? $kunjunganTBC->gender) == 'Laki-Laki' ? 'selected' : '' }}>
                                            Laki-Laki</option>
                                        <option value="Perempuan"
                                            {{ (old('gender') ?? $kunjunganTBC->gender) == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('gender')
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
                                <label for="kunjungan">Kunjungan</label>
                                <input type="number" class="form-control @error('kunjungan') is-invalid @enderror"
                                    name="kunjungan" id="kunjungan" placeholder="Kunjungan" autocomplete="off"
                                    value="{{ old('kunjungan') ?? $kunjunganTBC->kunjungan }}" required>
                                @error('kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_kunjungan">Tanggal Kunjungan</label>
                                <input type="date" class="form-control @error('tgl_kunjungan') is-invalid @enderror"
                                    name="tgl_kunjungan" id="tgl_kunjungan" autocomplete="off"
                                    value="{{ old('tgl_kunjungan') ?? $kunjunganTBC->tgl_kunjungan }}" required>
                                @error('tgl_kunjungan')
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
                                <h5>Skrining TBC</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="batuk_skrining">Batuk Terus Menerus</label>
                                    <select class="form-control @error('batuk_skrining') is-invalid @enderror"
                                        name="batuk_skrining" id="batuk_skrining" required>
                                        <option value="" disabled selected>Pilih Batuk Terus Menerus</option>
                                        <option value="Ya"
                                            {{ (old('batuk_skrining') ?? $kunjunganTBC->batuk_skrining) == 'Ya' ? 'selected' : '' }}>
                                            Ya</option>
                                        <option value="Tidak"
                                            {{ (old('batuk_skrining') ?? $kunjunganTBC->batuk_skrining) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('batuk_skrining')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="demam_skrining">Demam Lebih Dari > 2 Minggu</label>
                                    <select class="form-control @error('demam_skrining') is-invalid @enderror"
                                        name="demam_skrining" id="demam_skrining" required>
                                        <option value="" disabled selected>Pilih Demam</option>
                                        <option value="Ya"
                                            {{ (old('demam_skrining') ?? $kunjunganTBC->demam_skrining) == 'Ya' ? 'selected' : '' }}>
                                            Ya</option>
                                        <option value="Tidak"
                                            {{ (old('demam_skrining') ?? $kunjunganTBC->demam_skrining) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('demam_skrining')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bb_skrining">BB Tidak Naik Atau Turun Dalam 2 Bulan
                                        Berturut-Turut</label>
                                    <select class="form-control @error('bb_skrining') is-invalid @enderror"
                                        name="bb_skrining" id="bb_skrining" required>
                                        <option value="" disabled selected>Pilih BB</option>
                                        <option value="Ya"
                                            {{ (old('bb_skrining') ?? $kunjunganTBC->bb_skrining) == 'Ya' ? 'selected' : '' }}>
                                            Ya</option>
                                        <option value="Tidak"
                                            {{ (old('bb_skrining') ?? $kunjunganTBC->bb_skrining) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('bb_skrining')
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
                                <h5>Kontak Erat Dengan Pasien TBC</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="row" style="margin: 1%">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kontak_erat_keluarga">Keluarga</label>
                                    <select class="form-control @error('kontak_erat_keluarga') is-invalid @enderror"
                                        name="kontak_erat_keluarga" id="kontak_erat_keluarga">
                                        <option value="" disabled selected>Pilih Keluarga
                                        </option>
                                        <option value="Ya"
                                            {{ (old('kontak_erat_keluarga') ?? $kunjunganTBC->kontak_erat_keluarga) == 'Ya' ? 'selected' : '' }}>
                                            Ya</option>
                                        <option value="Tidak"
                                            {{ (old('kontak_erat_keluarga') ?? $kunjunganTBC->kontak_erat_keluarga) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('kontak_erat_keluarga')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kontak_erat_tetangga">Tetangga</label>
                                    <select class="form-control @error('kontak_erat_tetangga') is-invalid @enderror"
                                        name="kontak_erat_tetangga" id="kontak_erat_tetangga">
                                        <option value="" disabled selected>Pilih Tetangga
                                        </option>
                                        <option value="Ya"
                                            {{ (old('kontak_erat_tetangga') ?? $kunjunganTBC->kontak_erat_tetangga) == 'Ya' ? 'selected' : '' }}>
                                            Ya</option>
                                        <option value="Tidak"
                                            {{ (old('kontak_erat_tetangga') ?? $kunjunganTBC->kontak_erat_tetangga) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('kontak_erat_tetangga')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kontak_erat_art">ART</label>
                                    <select class="form-control @error('kontak_erat_art') is-invalid @enderror"
                                        name="kontak_erat_art" id="kontak_erat_art">
                                        <option value="" disabled selected>Pilih ART</option>
                                        <option value="Ya"
                                            {{ (old('kontak_erat_art') ?? $kunjunganTBC->kontak_erat_art) == 'Ya' ? 'selected' : '' }}>
                                            Ya</option>
                                        <option value="Tidak"
                                            {{ (old('kontak_erat_art') ?? $kunjunganTBC->kontak_erat_art) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('kontak_erat_art')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--  --}}
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Terdiagnosa TBC</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_diaknosa">Tanggal</label>
                                    <input type="date"
                                        class="form-control @error('tgl_diaknosa') is-invalid @enderror"
                                        name="tgl_diaknosa" id="tgl_diaknosa" autocomplete="off"
                                        value="{{ old('tgl_diaknosa') ?? $kunjunganTBC->tgl_diaknosa }}">
                                    @error('tgl_diaknosa')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tmp_diaknosa">Tempat</label>
                                    <select class="form-control @error('tmp_diaknosa') is-invalid @enderror"
                                        name="tmp_diaknosa" id="tmp_diaknosa" required>
                                        <option value="" disabled selected>Pilih Tempat</option>
                                        <option value="Rumah Sakit"
                                            {{ (old('tmp_diaknosa') ?? $kunjunganTBC->tmp_diaknosa) == 'Rumah Sakit' ? 'selected' : '' }}>
                                            Rumah Sakit</option>
                                        <option value="Puskesmas"
                                            {{ (old('tmp_diaknosa') ?? $kunjunganTBC->tmp_diaknosa) == 'Puskesmas' ? 'selected' : '' }}>
                                            Puskesmas</option>
                                        <option value="Rumah"
                                            {{ (old('tmp_diaknosa') ?? $kunjunganTBC->tmp_diaknosa) == 'Rumah' ? 'selected' : '' }}>
                                            Rumah</option>
                                    </select>
                                    @error('tmp_diaknosa')
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
                                <h5>Pemeriksaan Terakhir</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_periksa_terakhir">Tanggal</label>
                                    <input type="date"
                                        class="form-control @error('tgl_periksa_terakhir') is-invalid @enderror"
                                        name="tgl_periksa_terakhir" id="tgl_periksa_terakhir" autocomplete="off"
                                        value="{{ old('tgl_periksa_terakhir') ?? $kunjunganTBC->tgl_periksa_terakhir }}">
                                    @error('tgl_periksa_terakhir')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tmp_periksa_terakhir">Tempat</label>
                                    <select class="form-control @error('tmp_periksa_terakhir') is-invalid @enderror"
                                        name="tmp_periksa_terakhir" id="tmp_periksa_terakhir" required>
                                        <option value="" disabled selected>Pilih Tempat</option>
                                        <option value="Rumah Sakit"
                                            {{ (old('tmp_periksa_terakhir') ?? $kunjunganTBC->tmp_periksa_terakhir) == 'Rumah Sakit' ? 'selected' : '' }}>
                                            Rumah Sakit</option>
                                        <option value="Puskesmas"
                                            {{ (old('tmp_periksa_terakhir') ?? $kunjunganTBC->tmp_periksa_terakhir) == 'Puskesmas' ? 'selected' : '' }}>
                                            Puskesmas</option>
                                        <option value="Rumah"
                                            {{ (old('tmp_periksa_terakhir') ?? $kunjunganTBC->tmp_periksa_terakhir) == 'Rumah' ? 'selected' : '' }}>
                                            Rumah</option>
                                    </select>
                                    @error('tmp_periksa_terakhir')
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
                                <h5>Obat TBC</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin: 2%">
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="obat_tbc">Obat</label>
                                    <select class="form-control @error('obat_tbc') is-invalid @enderror" name="obat_tbc"
                                        id="obat_tbc" required>
                                        <option value="" disabled selected>Pilih Ketersediaan Obat</option>
                                        <option value="Ada"
                                            {{ (old('obat_tbc') ?? $kunjunganTBC->obat_tbc) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak"
                                            {{ (old('obat_tbc') ?? $kunjunganTBC->obat_tbc) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('obat_tbc')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minum_obat_tbc">Sudah Minum Obat Hari Ini / 24 Jam Terakhir</label>
                                    <select class="form-control @error('minum_obat_tbc') is-invalid @enderror"
                                        name="minum_obat_tbc" id="minum_obat_tbc" required>
                                        <option value="" disabled selected>Pilih</option>
                                        <option value="Ya"
                                            {{ (old('minum_obat_tbc') ?? $kunjunganTBC->minum_obat_tbc) == 'Ya' ? 'selected' : '' }}>
                                            Ya</option>
                                        <option value="Tidak"
                                            {{ (old('minum_obat_tbc') ?? $kunjunganTBC->minum_obat_tbc) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('minum_obat_tbc')
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
                                <label for="nama_pmo">Nama PMO</label>
                                <input type="text" class="form-control @error('nama_pmo') is-invalid @enderror"
                                    name="nama_pmo" id="nama_pmo" autocomplete="off"
                                    value="{{ old('nama_pmo') ?? $kunjunganTBC->nama_pmo }}"
                                    placeholder="Masukkan nama PMO">
                                @error('nama_pmo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="merokok">Merokok</label>
                                <select class="form-control @error('merokok') is-invalid @enderror" name="merokok"
                                    id="merokok" required>
                                    <option value="" disabled selected>Pilih Status Merokok</option>
                                    <option value="Aktif"
                                        {{ (old('merokok') ?? $kunjunganTBC->merokok) == 'Aktif' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="Pasif"
                                        {{ (old('merokok') ?? $kunjunganTBC->merokok) == 'Pasif' ? 'selected' : '' }}>
                                        Pasif</option>
                                </select>
                                @error('merokok')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edukasi">Edukasi</label>
                                <input type="text" class="form-control @error('edukasi') is-invalid @enderror"
                                    name="edukasi" id="edukasi" autocomplete="off"
                                    value="{{ old('edukasi') ?? $kunjunganTBC->edukasi }}"
                                    placeholder="Masukkan edukasi">
                                @error('edukasi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="periksa_postu_fasyankes">Periksa Postu Fasyankes</label>
                                <input type="text"
                                    class="form-control @error('periksa_postu_fasyankes') is-invalid @enderror"
                                    name="periksa_postu_fasyankes" id="periksa_postu_fasyankes" autocomplete="off"
                                    value="{{ old('periksa_postu_fasyankes') ?? $kunjunganTBC->periksa_postu_fasyankes }}"
                                    placeholder="Masukkan periksa postu fasyankes">
                                @error('periksa_postu_fasyankes')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_lapor">Tanggal Lapor</label>
                                <input type="date" class="form-control @error('tgl_lapor') is-invalid @enderror"
                                    name="tgl_lapor" id="tgl_lapor" autocomplete="off"
                                    value="{{ old('tgl_lapor') ?? $kunjunganTBC->tgl_lapor }}">
                                @error('tgl_lapor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="setAction('save')">Simpan</button>
                    <a href="{{ route('kunjungan_tbc.index') }}" class="btn btn-default">Kembali Ke List</a>
                </div>

            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var statusSelect = document.getElementById('status');
            var fields = {
                'nik': document.getElementById('nik'),
                'nama': document.getElementById('nama'),
                'tgl_lahir': document.getElementById('tgl_lahir'),
                'tmp_lahir': document.getElementById('tmp_lahir'),
                'gender': document.getElementById('gender'),
                'kunjungan': document.getElementById('kunjungan'),
                'tgl_kunjungan': document.getElementById('tgl_kunjungan'),
                'batuk_skrining': document.getElementById('batuk_skrining'),
                'demam_skrining': document.getElementById('demam_skrining'),
                'bb_skrining': document.getElementById('bb_skrining'),
                'kontak_erat_skrining': document.getElementById('kontak_erat_skrining'),
                'tgl_diaknosa': document.getElementById('tgl_diaknosa'),
                'tmp_diaknosa': document.getElementById('tmp_diaknosa'),
                'tgl_periksa_terakhir': document.getElementById('tgl_periksa_terakhir'),
                'tmp_periksa_terakhir': document.getElementById('tmp_periksa_terakhir'),
                'obat_tbc': document.getElementById('obat_tbc'),
                'minum_obat_tbc': document.getElementById('minum_obat_tbc'),
                'nama_pmo': document.getElementById('nama_pmo'),
                'merokok': document.getElementById('merokok'),
                'edukasi': document.getElementById('edukasi'),
                'periksa_postu_fasyankes': document.getElementById('periksa_postu_fasyankes'),
                'tgl_lapor': document.getElementById('tgl_lapor')
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
                var isActive = status === 'Ya' || status === 'Selesai';
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
