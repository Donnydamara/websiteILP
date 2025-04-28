@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Update Detail Ibu Bersalin Nifas') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body" style="text-align: center;">

            <form action="{{ route('ibu_bersalin_nifas.updatedetail', ['id' => $ibuhamilNifas->id]) }}" method="post"
                id="modal-save-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">Status Ibu Bersalin Nifas</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status"
                        required>
                        <option value="">Pilih</option>
                        <option value="Ya" {{ old('status') ?? $ibuhamilNifas->status === 'Ya' ? 'selected' : '' }}>Ya
                        </option>
                        <option value="Tidak" {{ old('status') ?? $ibuhamilNifas->status === 'Tidak' ? 'selected' : '' }}>
                            Tidak</option>
                        <option value="Selesai"
                            {{ old('status') ?? $ibuhamilNifas->status === 'Selesai' ? 'selected' : '' }}>
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
                                    value="{{ old('kk') ?? $ibuhamilNifas->kk }}" required readonly>
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
                                    value="{{ old('nama') ?? $ibuhamilNifas->nama }}" required readonly>
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
                                    value="{{ old('nik') ?? $ibuhamilNifas->nik }}" required readonly>
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
                                <label for="umur_ibu">Umur Ibu</label>
                                <input type="number" class="form-control @error('umur_ibu') is-invalid @enderror"
                                    name="umur_ibu" id="umur_ibu" placeholder="Umur Ibu" autocomplete="off"
                                    value="{{ old('umur_ibu') ?? $ibuhamilNifas->umur_ibu }}" required>
                                @error('umur_ibu')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kelahiran_ke">Kelahiran Anak Ke</label>
                                <input type="number" class="form-control @error('kelahiran_ke') is-invalid @enderror"
                                    name="kelahiran_ke" id="kelahiran_ke" placeholder="Kelahiran Anak Ke" autocomplete="off"
                                    value="{{ old('kelahiran_ke') ?? $ibuhamilNifas->kelahiran_ke }}">
                                @error('kelahiran_ke')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_persalinan">Tanggal Prsalinan</label>
                                <input type="date" class="form-control @error('tgl_persalinan') is-invalid @enderror"
                                    name="tgl_persalinan" id="tgl_persalinan" placeholder="Tanggal Prsalinan"
                                    autocomplete="off"
                                    value="{{ old('tgl_persalinan') ?? $ibuhamilNifas->tgl_persalinan }}" required>
                                @error('tgl_persalinan')
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
                                <label for="pukul_persalinan">Pukul Persalinan</label>
                                <input type="time" class="form-control @error('pukul_persalinan') is-invalid @enderror"
                                    name="pukul_persalinan" id="pukul_persalinan"
                                    value="{{ old('pukul_persalinan') ?? (isset($ibuhamilNifas) ? date('H:i', strtotime($ibuhamilNifas->pukul_persalinan)) : '') }}"
                                    required step="300">
                                @error('pukul_persalinan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="usia_kehamilan_persalinan">Usia Kehamilan Persalinan</label>
                                <input type="number"
                                    class="form-control @error('usia_kehamilan_persalinan') is-invalid @enderror"
                                    name="usia_kehamilan_persalinan" id="usia_kehamilan_persalinan"
                                    placeholder="Usia Kehamilan Persalinan" autocomplete="off"
                                    value="{{ old('usia_kehamilan_persalinan') ?? $ibuhamilNifas->usia_kehamilan_persalinan }}"
                                    required>
                                @error('usia_kehamilan_persalinan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="penolong_persalinan">Penolong Persalinan</label>
                                    <select class="form-control @error('penolong_persalinan') is-invalid @enderror"
                                        name="penolong_persalinan" id="penolong_persalinan" required>
                                        <option value="">Pilih Penolong Persalinan</option>
                                        <option value="Bidan"
                                            {{ (old('penolong_persalinan') ?? $ibuhamilNifas->penolong_persalinan) === 'Bidan' ? 'selected' : '' }}>
                                            Bidan</option>
                                        <option value="Dokter Umum"
                                            {{ (old('penolong_persalinan') ?? $ibuhamilNifas->penolong_persalinan) === 'Dokter Umum' ? 'selected' : '' }}>
                                            Dokter Umum
                                        </option>
                                        <option value="Dokter SpOG"
                                            {{ (old('penolong_persalinan') ?? $ibuhamilNifas->penolong_persalinan) === 'Dokter SpOG' ? 'selected' : '' }}>
                                            Dokter SpOG
                                        </option>
                                        <option value="lainnya"
                                            {{ (old('penolong_persalinan') ?? $ibuhamilNifas->penolong_persalinan) === 'lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('penolong_persalinan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                        <label for="lainya_penolong_persalinan">Lainnya</label>
                                        <input type="text"
                                            class="form-control @error('lainya_penolong_persalinan') is-invalid @enderror"
                                            name="lainya_penolong_persalinan" id="lainya_penolong_persalinan"
                                            placeholder="Lainnya" autocomplete="off"
                                            value="{{ old('lainya_penolong_persalinan') ?? $ibuhamilNifas->lainya_penolong_persalinan }}"
                                            data-old="{{ old('lainya_penolong_persalinan') ?? $ibuhamilNifas->lainya_penolong_persalinan }}"
                                            required>
                                        @error('lainya_penolong_persalinan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tmpt_persalinan">Tempat Persalinan</label>
                                <select class="form-control @error('tmpt_persalinan') is-invalid @enderror"
                                    name="tmpt_persalinan" id="tmpt_persalinan" required>
                                    <option value="">Pilih Tempat Persalinan</option>
                                    <option value="Puskesmas"
                                        {{ (old('tmpt_persalinan') ?? $ibuhamilNifas->tmpt_persalinan) === 'Puskesmas' ? 'selected' : '' }}>
                                        Puskesmas</option>
                                    <option value="Rumah Sakit"
                                        {{ (old('tmpt_persalinan') ?? $ibuhamilNifas->tmpt_persalinan) === 'Rumah Sakit' ? 'selected' : '' }}>
                                        Rumah Sakit</option>
                                    <option value="Klinik"
                                        {{ (old('tmpt_persalinan') ?? $ibuhamilNifas->tmpt_persalinan) === 'Klinik' ? 'selected' : '' }}>
                                        Klinik</option>
                                    <option value="Praktik Bidan Mandiri"
                                        {{ (old('tmpt_persalinan') ?? $ibuhamilNifas->tmpt_persalinan) === 'Praktik Bidan Mandiri' ? 'selected' : '' }}>
                                        Praktik Bidan Mandiri</option>
                                    <option value="Rumah"
                                        {{ (old('tmpt_persalinan') ?? $ibuhamilNifas->tmpt_persalinan) === 'Rumah' ? 'selected' : '' }}>
                                        Rumah</option>
                                    <option value="lainnya"
                                        {{ (old('tmpt_persalinan') ?? $ibuhamilNifas->tmpt_persalinan) === 'lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                                @error('tmpt_persalinan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_tmpt_persalinan">Nama Tempat Persalinan</label>
                                <input type="text"
                                    class="form-control @error('nama_tmpt_persalinan') is-invalid @enderror"
                                    name="nama_tmpt_persalinan" id="nama_tmpt_persalinan"
                                    placeholder="Nama Tempat Persalinan" autocomplete="off"
                                    value="{{ old('nama_tmpt_persalinan') ?? $ibuhamilNifas->nama_tmpt_persalinan }}"
                                    required>
                                @error('nama_tmpt_persalinan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="cara_persalinan">Cara Persalinan</label>
                                    <select class="form-control @error('cara_persalinan') is-invalid @enderror"
                                        name="cara_persalinan" id="cara_persalinan" required>
                                        <option value="">Pilih Cara Persalinan</option>
                                        <option value="Persalinan Normal"
                                            {{ (old('cara_persalinan') ?? $ibuhamilNifas->cara_persalinan) === 'Persalinan Normal' ? 'selected' : '' }}>
                                            Persalinan Normal</option>
                                        <option value="Persalinan Dengan Tindakan"
                                            {{ (old('cara_persalinan') ?? $ibuhamilNifas->cara_persalinan) === 'Persalinan Dengan Tindakan' ? 'selected' : '' }}>
                                            Persalinan Dengan Tindakan</option>
                                        <option value="lainnya"
                                            {{ (old('cara_persalinan') ?? $ibuhamilNifas->cara_persalinan) === 'lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control @error('lainya_cara_persalinan') is-invalid @enderror"
                                            name="lainya_cara_persalinan" id="lainya_cara_persalinan"
                                            placeholder="Lainnya" autocomplete="off"
                                            value="{{ old('lainya_cara_persalinan') ?? $ibuhamilNifas->lainya_cara_persalinan }}"
                                            data-old="{{ old('lainya_cara_persalinan') ?? $ibuhamilNifas->lainya_cara_persalinan }}"
                                            required>
                                        @error('lainya_cara_persalinan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 2%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="keadaan_ibu_persalinan">Keadaan Ibu Pada Saat Melahirkan</label>
                                <select class="form-control @error('keadaan_ibu_persalinan') is-invalid @enderror"
                                    name="keadaan_ibu_persalinan" id="keadaan_ibu_persalinan" required>
                                    <option value="">Pilih Keadaan Ibu Pada Saat Melahirkan</option>
                                    <option value="Sehat"
                                        {{ (old('keadaan_ibu_persalinan') ?? $ibuhamilNifas->keadaan_ibu_persalinan) === 'Sehat' ? 'selected' : '' }}>
                                        Sehat</option>
                                    <option value="Sakit (Pendarahan/Demam/Kejang/Lokhia Berbau/Lain-lain)"
                                        {{ (old('keadaan_ibu_persalinan') ?? $ibuhamilNifas->keadaan_ibu_persalinan) === 'Sakit (Pendarahan/Demam/Kejang/Lokhia Berbau/Lain-lain)' ? 'selected' : '' }}>
                                        Sakit (Pendarahan/Demam/Kejang/Lokhia Berbau/Lain-lain)</option>
                                </select>
                                @error('keadaan_ibu_persalinan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="riwayat_imd_persalinan">Riwayat Inisiasi Menyusui Dini (IMD)</label>
                                <select class="form-control @error('riwayat_imd_persalinan') is-invalid @enderror"
                                    name="riwayat_imd_persalinan" id="riwayat_imd_persalinan" required>
                                    <option value="">Pilih Riwayat Inisiasi Menyusui Dini (IMD)</option>
                                    <option value="Ya"
                                        {{ (old('riwayat_imd_persalinan') ?? $ibuhamilNifas->riwayat_imd_persalinan) === 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('riwayat_imd_persalinan') ?? $ibuhamilNifas->riwayat_imd_persalinan) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('riwayat_imd_persalinan')
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
                                    value="{{ old('kunjungan') ?? $ibuhamilNifas->kunjungan }}" required>
                                @error('kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_kunjungan">Tanggal Kunjungan</label>
                                <input type="date" class="form-control @error('tgl_kunjungan') is-invalid @enderror"
                                    name="tgl_kunjungan" id="tgl_kunjungan" placeholder="Tanggal Kunjungan"
                                    autocomplete="off"
                                    value="{{ old('tgl_kunjungan') ?? $ibuhamilNifas->tgl_kunjungan }}" required>
                                @error('tgl_kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="suhu_tubuh">Pemantauan Suhu Tubuh</label>
                                <select class="form-control @error('suhu_tubuh') is-invalid @enderror" name="suhu_tubuh"
                                    id="suhu_tubuh" required>
                                    <option value="">Pilih Pemantauan Suhu Tubuh</option>
                                    <option value="<37,5 C"
                                        {{ (old('suhu_tubuh') ?? $ibuhamilNifas->suhu_tubuh) === '<37,5 C' ? 'selected' : '' }}>
                                        &lt;37,5 C</option>
                                    <option value=">37,5 C"
                                        {{ (old('suhu_tubuh') ?? $ibuhamilNifas->suhu_tubuh) === '>37,5 C' ? 'selected' : '' }}>
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
                                <select class="form-control @error('buku_ka') is-invalid @enderror" name="buku_ka"
                                    id="buku_ka" required>
                                    <option value="">Pilih</option>
                                    <option value="Ada"
                                        {{ (old('buku_ka') ?? $ibuhamilNifas->buku_ka) == 'Ada' ? 'selected' : '' }}>Ada
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('buku_ka') ?? $ibuhamilNifas->buku_ka) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('buku_ka')
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
                                <h5>Ibu memeriksa kesehatannya ke posyandu Prima/ Puskesmas/
                                    Fasyankes lainnya atau kunjungan rumah oleh nakes dan untuk melakukan pemeriksaan
                                    setelah melahirkan</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control @error('pemeriksaan_kesehatan') is-invalid @enderror"
                                    name="pemeriksaan_kesehatan" id="pemeriksaan_kesehatan" required>
                                    <option value="">Pilih Pemeriksaan Kesehatan</option>
                                    <option value="KF1 (6 Jam - 48 Jam)"
                                        {{ (old('pemeriksaan_kesehatan') ?? $ibuhamilNifas->pemeriksaan_kesehatan) === 'KF1 (6 Jam - 48 Jam)' ? 'selected' : '' }}>
                                        KF1 (6 Jam - 48 Jam)</option>
                                    <option value="KF2 (3 - 7 Hari Pasca Persalinan)"
                                        {{ (old('pemeriksaan_kesehatan') ?? $ibuhamilNifas->pemeriksaan_kesehatan) === 'KF2 (3 - 7 Hari Pasca Persalinan)' ? 'selected' : '' }}>
                                        KF2 (3 - 7 Hari Pasca Persalinan)</option>
                                    <option value="KF3 (8 - 28 Hari Pasca Persalinan)"
                                        {{ (old('pemeriksaan_kesehatan') ?? $ibuhamilNifas->pemeriksaan_kesehatan) === 'KF3 (8 - 28 Hari Pasca Persalinan)' ? 'selected' : '' }}>
                                        KF3 (8 - 28 Hari Pasca Persalinan)</option>
                                    <option value="KF4 (29 - 42 Hari Pasca Persalinan)"
                                        {{ (old('pemeriksaan_kesehatan') ?? $ibuhamilNifas->pemeriksaan_kesehatan) === 'KF4 (29 - 42 Hari Pasca Persalinan)' ? 'selected' : '' }}>
                                        KF4 (29 - 42 Hari Pasca Persalinan)</option>
                                </select>
                                @error('pemeriksaan_kesehatan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_pk">Tanggal Pemeriksaan</label>
                                <input type="date" class="form-control @error('tgl_pk') is-invalid @enderror"
                                    name="tgl_pk" id="tgl_pk" placeholder="Tanggal Pemeriksaan" autocomplete="off"
                                    value="{{ old('tgl_pk') ?? $ibuhamilNifas->tgl_pk }}" required>
                                @error('tgl_pk')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tempat_pk">Tempat Pemeriksaan</label>
                                <select class="form-control @error('tempat_pk') is-invalid @enderror" name="tempat_pk"
                                    id="tempat_pk" required>
                                    <option value="">Pilih Tempat Pemeriksaan</option>
                                    <option value="Rumah Sakit"
                                        {{ (old('tempat_pk') ?? $ibuhamilNifas->tempat_pk) === 'Rumah Sakit' ? 'selected' : '' }}>
                                        Rumah Sakit</option>
                                    <option value="Puskesmas"
                                        {{ (old('tempat_pk') ?? $ibuhamilNifas->tempat_pk) === 'Puskesmas' ? 'selected' : '' }}>
                                        Puskesmas</option>
                                    <option value="Polindes"
                                        {{ (old('tempat_pk') ?? $ibuhamilNifas->tempat_pk) === 'Polindes' ? 'selected' : '' }}>
                                        Polindes</option>
                                    <option value="BPM"
                                        {{ (old('tempat_pk') ?? $ibuhamilNifas->tempat_pk) === 'BPM' ? 'selected' : '' }}>
                                        BPM</option>
                                    <option value="Rumah"
                                        {{ (old('tempat_pk') ?? $ibuhamilNifas->tempat_pk) === 'Rumah' ? 'selected' : '' }}>
                                        Rumah</option>
                                </select>
                                @error('tempat_pk')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="petugas_pk">Petugas Pemeriksaan</label>
                                <select class="form-control @error('petugas_pk') is-invalid @enderror" name="petugas_pk"
                                    id="petugas_pk" required>
                                    <option value="">Pilih Petugas Pemeriksaan</option>
                                    <option value="Dokter"
                                        {{ (old('petugas_pk') ?? $ibuhamilNifas->petugas_pk) === 'Dokter' ? 'selected' : '' }}>
                                        Dokter</option>
                                    <option value="Bidan"
                                        {{ (old('petugas_pk') ?? $ibuhamilNifas->petugas_pk) === 'Bidan' ? 'selected' : '' }}>
                                        Bidan</option>
                                    <option value="Perawat"
                                        {{ (old('petugas_pk') ?? $ibuhamilNifas->petugas_pk) === 'Perawat' ? 'selected' : '' }}>
                                        Perawat</option>
                                    <option value="Kader"
                                        {{ (old('petugas_pk') ?? $ibuhamilNifas->petugas_pk) === 'Kader' ? 'selected' : '' }}>
                                        Kader</option>
                                </select>
                                @error('petugas_pk')
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
                                <h5>Isi Piring Ibu Menyusui</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control @error('porsi') is-invalid @enderror" name="porsi"
                                    id="porsi" required>
                                    <option value="">Pilih Isi Piring Ibu Menyusui</option>
                                    <option value="Sesuai"
                                        {{ (old('porsi') ?? $ibuhamilNifas->porsi) === 'Sesuai' ? 'selected' : '' }}>Sesuai
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('porsi') ?? $ibuhamilNifas->porsi) === 'Tidak' ? 'selected' : '' }}>Tidak
                                    </option>
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
                                <h5>Kapsul Vitamin A</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ada_kva">ADA</label>
                                <select class="form-control @error('ada_kva') is-invalid @enderror" name="ada_kva"
                                    id="ada_kva" required>
                                    <option value="">Pilih ADA</option>
                                    <option value="Ya"
                                        {{ (old('ada_kva') ?? $ibuhamilNifas->ada_kva) === 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('ada_kva') ?? $ibuhamilNifas->ada_kva) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('ada_kva')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wkt_minum_kva">Waktu Minum</label>
                                <input type="date" class="form-control @error('wkt_minum_kva') is-invalid @enderror"
                                    name="wkt_minum_kva" id="wkt_minum_kva" placeholder="Waktu Minum" autocomplete="off"
                                    value="{{ old('wkt_minum_kva') ?? $ibuhamilNifas->wkt_minum_kva }}" required>
                                @error('wkt_minum_kva')
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
                                <label for="menyusui">Menyusui</label>
                                <select class="form-control @error('menyusui') is-invalid @enderror" name="menyusui"
                                    id="menyusui" required>
                                    <option value="">Pilih Menyusui</option>
                                    <option value="Ya"
                                        {{ (old('menyusui') ?? $ibuhamilNifas->menyusui) === 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('menyusui') ?? $ibuhamilNifas->menyusui) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('menyusui')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kb_pasca_persalinan">KB Pasca Persalinan</label>
                                <select class="form-control @error('kb_pasca_persalinan') is-invalid @enderror"
                                    name="kb_pasca_persalinan" id="kb_pasca_persalinan" required>
                                    <option value="">Pilih KB Pasca Persalinan</option>
                                    <option value="MOW"
                                        {{ (old('kb_pasca_persalinan') ?? $ibuhamilNifas->kb_pasca_persalinan) === 'MOW' ? 'selected' : '' }}>
                                        MOW</option>
                                    <option value="IUD"
                                        {{ (old('kb_pasca_persalinan') ?? $ibuhamilNifas->kb_pasca_persalinan) === 'IUD' ? 'selected' : '' }}>
                                        IUD</option>
                                    <option value="Implan"
                                        {{ (old('kb_pasca_persalinan') ?? $ibuhamilNifas->kb_pasca_persalinan) === 'Implan' ? 'selected' : '' }}>
                                        Implan</option>
                                    <option value="Suntik"
                                        {{ (old('kb_pasca_persalinan') ?? $ibuhamilNifas->kb_pasca_persalinan) === 'Suntik' ? 'selected' : '' }}>
                                        Suntik</option>
                                </select>
                                @error('kb_pasca_persalinan')
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
                                <label for="skrining_kesehatan">Tanggal</label>
                                <input type="date"
                                    class="form-control @error('skrining_kesehatan') is-invalid @enderror"
                                    name="skrining_kesehatan" id="skrining_kesehatan" placeholder="Tanggal"
                                    autocomplete="off"
                                    value="{{ old('skrining_kesehatan') ?? $ibuhamilNifas->skrining_kesehatan }}"
                                    required>
                                @error('skrining_kesehatan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="skrining_kesehatan_tmp">Tempat</label>
                                <select class="form-control @error('skrining_kesehatan_tmp') is-invalid @enderror"
                                    name="skrining_kesehatan_tmp" id="skrining_kesehatan_tmp" required>
                                    <option value="">Pilih Tempat</option>
                                    <option value="Rumah"
                                        {{ (old('skrining_kesehatan_tmp') ?? $ibuhamilNifas->skrining_kesehatan_tmp) === 'Rumah' ? 'selected' : '' }}>
                                        Rumah</option>
                                    <option value="Posyandu"
                                        {{ (old('skrining_kesehatan_tmp') ?? $ibuhamilNifas->skrining_kesehatan_tmp) === 'Posyandu' ? 'selected' : '' }}>
                                        Posyandu</option>
                                </select>
                                @error('skrining_kesehatan_tmp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="skrining_kesehatan_petugas">Petugas</label>
                                <select class="form-control @error('skrining_kesehatan_petugas') is-invalid @enderror"
                                    name="skrining_kesehatan_petugas" id="skrining_kesehatan_petugas" required>
                                    <option value="">Pilih Petugas</option>
                                    <option value="Petugas Puskesmas"
                                        {{ (old('skrining_kesehatan_petugas') ?? $ibuhamilNifas->skrining_kesehatan_petugas) === 'Petugas Puskesmas' ? 'selected' : '' }}>
                                        Petugas Puskesmas</option>
                                    <option value="Kader"
                                        {{ (old('skrining_kesehatan_petugas') ?? $ibuhamilNifas->skrining_kesehatan_petugas) === 'Kader' ? 'selected' : '' }}>
                                        Kader</option>
                                </select>
                                @error('skrining_kesehatan_petugas')
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
                                <h5>Pemberian Edukasi/ Kunjungan Nakes</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="date"
                                    class="form-control @error('edukasi_kunjungan') is-invalid @enderror"
                                    name="edukasi_kunjungan" id="edukasi_kunjungan"
                                    placeholder="Pemberian Edukasi/ Kunjungan Nakes" autocomplete="off"
                                    value="{{ old('edukasi_kunjungan') ?? $ibuhamilNifas->edukasi_kunjungan }}" required>
                                @error('edukasi_kunjungan')
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
                                <label for="demam">Demam</label>
                                <select class="form-control @error('demam') is-invalid @enderror" name="demam"
                                    id="demam" required>
                                    <option value="">Pilih Demam</option>
                                    <option value="Ya"
                                        {{ (old('demam') ?? $ibuhamilNifas->demam) === 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('demam') ?? $ibuhamilNifas->demam) === 'Tidak' ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>
                                @error('demam')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="perasaan">Ada perasaan bersalah, mudah menangis, kehilangan minat, gelisah,
                                    gangguan tidur, gangguan konsentrasi</label>
                                <select class="form-control @error('perasaan') is-invalid @enderror" name="perasaan"
                                    id="perasaan" required>
                                    <option value="">Pilih Perasaan</option>
                                    <option value="Ya"
                                        {{ (old('perasaan') ?? $ibuhamilNifas->perasaan) === 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('perasaan') ?? $ibuhamilNifas->perasaan) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('perasaan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sakit">Tidak bisa BAK, BAK sedikit tapi sering, terasa panas, nyeri panggul,
                                    urin keluar tanpa disadari</label>
                                <select class="form-control @error('sakit') is-invalid @enderror" name="sakit"
                                    id="sakit" required>
                                    <option value="">Pilih Sakit</option>
                                    <option value="Ya"
                                        {{ (old('sakit') ?? $ibuhamilNifas->sakit) === 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('sakit') ?? $ibuhamilNifas->sakit) === 'Tidak' ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>
                                @error('sakit')
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
                                <label for="pernafasan">Nafas pendek dan terengah-engah, nafas dangkal disertasi nyeri
                                    dada, nafas berat, batuk lebih dari 2 (dua) hari</label>
                                <select class="form-control @error('pernafasan') is-invalid @enderror" name="pernafasan"
                                    id="pernafasan" required>
                                    <option value="">Pilih Pernafasan</option>
                                    <option value="Ya"
                                        {{ (old('pernafasan') ?? $ibuhamilNifas->pernafasan) === 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('pernafasan') ?? $ibuhamilNifas->pernafasan) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('pernafasan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="payudara">Payudara bengkak kemerahan disertai nyeri, benjolan disertai nyeri
                                    ada keluhan dalam menyusul</label>
                                <select class="form-control @error('payudara') is-invalid @enderror" name="payudara"
                                    id="payudara" required>
                                    <option value="">Pilih Payudara</option>
                                    <option value="Ya"
                                        {{ (old('payudara') ?? $ibuhamilNifas->payudara) === 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('payudara') ?? $ibuhamilNifas->payudara) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('payudara')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sakit_kepala">Sakit Kepala</label>
                                <select class="form-control @error('sakit_kepala') is-invalid @enderror"
                                    name="sakit_kepala" id="sakit_kepala" required>
                                    <option value="">Pilih Sakit Kepala</option>
                                    <option value="Ya"
                                        {{ (old('sakit_kepala') ?? $ibuhamilNifas->sakit_kepala) === 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('sakit_kepala') ?? $ibuhamilNifas->sakit_kepala) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('sakit_kepala')
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
                                <label for="pendarahan">Pendarahan (pembalut basah dalam 5 menit)</label>
                                <select class="form-control @error('pendarahan') is-invalid @enderror" name="pendarahan"
                                    id="pendarahan" required>
                                    <option value="">Pilih Pendarahan</option>
                                    <option value="Ya"
                                        {{ (old('pendarahan') ?? $ibuhamilNifas->pendarahan) === 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('pendarahan') ?? $ibuhamilNifas->pendarahan) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('pendarahan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sakit_bagian_kelamin">Area sekitar kelamin bengkak atau nyeri atau ada luka
                                    terbuka</label>
                                <select class="form-control @error('sakit_bagian_kelamin') is-invalid @enderror"
                                    name="sakit_bagian_kelamin" id="sakit_bagian_kelamin" required>
                                    <option value="">Pilih Sakit Bagian Kelamin</option>
                                    <option value="Ya"
                                        {{ (old('sakit_bagian_kelamin') ?? $ibuhamilNifas->sakit_bagian_kelamin) === 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('sakit_bagian_kelamin') ?? $ibuhamilNifas->sakit_bagian_kelamin) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('sakit_bagian_kelamin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="keluar_cairan">Keluar cairan dari dalam jalan lahir</label>
                                <select class="form-control @error('keluar_cairan') is-invalid @enderror"
                                    name="keluar_cairan" id="keluar_cairan" required>
                                    <option value="">Pilih Keluar Cairan</option>
                                    <option value="Ya"
                                        {{ (old('keluar_cairan') ?? $ibuhamilNifas->keluar_cairan) === 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('keluar_cairan') ?? $ibuhamilNifas->keluar_cairan) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('keluar_cairan')
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
                                <label for="pandangan_kabur">Pandangan Kabur</label>
                                <select class="form-control @error('pandangan_kabur') is-invalid @enderror"
                                    name="pandangan_kabur" id="pandangan_kabur" required>
                                    <option value="">Pilih Pandangan Kabur</option>
                                    <option value="Ya"
                                        {{ (old('pandangan_kabur') ?? $ibuhamilNifas->pandangan_kabur) === 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('pandangan_kabur') ?? $ibuhamilNifas->pandangan_kabur) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('pandangan_kabur')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="darah_nifas">Darah nifas berbau atau mengalir atau ada nyeri pada perut
                                    bawah</label>
                                <select class="form-control @error('darah_nifas') is-invalid @enderror"
                                    name="darah_nifas" id="darah_nifas" required>
                                    <option value="">Pilih Darah Nifas</option>
                                    <option value="Ya"
                                        {{ (old('darah_nifas') ?? $ibuhamilNifas->darah_nifas) === 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('darah_nifas') ?? $ibuhamilNifas->darah_nifas) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('darah_nifas')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="keputihan">Keputihan berlebih. berwarna dan berbau</label>
                                <select class="form-control @error('keputihan') is-invalid @enderror" name="keputihan"
                                    id="keputihan" required>
                                    <option value="">Pilih Keputihan</option>
                                    <option value="Ya"
                                        {{ (old('keputihan') ?? $ibuhamilNifas->keputihan) === 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('keputihan') ?? $ibuhamilNifas->keputihan) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('keputihan')
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
                                <label for="jantung_berdebar">Jantung Berdebar</label>
                                <select class="form-control @error('jantung_berdebar') is-invalid @enderror"
                                    name="jantung_berdebar" id="jantung_berdebar" required>
                                    <option value="">Pilih Jantung Berdebar</option>
                                    <option value="Ya"
                                        {{ (old('jantung_berdebar') ?? $ibuhamilNifas->jantung_berdebar) === 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('jantung_berdebar') ?? $ibuhamilNifas->jantung_berdebar) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('jantung_berdebar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pengingat_periksa_postu">Mengingatkan periksa ke Postu/Fasyankes</label>
                                <select class="form-control @error('pengingat_periksa_postu') is-invalid @enderror"
                                    name="pengingat_periksa_postu" id="pengingat_periksa_postu" required>
                                    <option value="">Pilih</option>
                                    <option value="Ya"
                                        {{ (old('pengingat_periksa_postu') ?? $ibuhamilNifas->pengingat_periksa_postu) === 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('pengingat_periksa_postu') ?? $ibuhamilNifas->pengingat_periksa_postu) === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('pengingat_periksa_postu')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_laporan_nakes">Melaporkan ke Nakes</label>
                                <input type="date"
                                    class="form-control @error('tgl_laporan_nakes') is-invalid @enderror"
                                    name="tgl_laporan_nakes" id="tgl_laporan_nakes" placeholder="tanggal"
                                    autocomplete="off"
                                    value="{{ old('tgl_laporan_nakes') ?? $ibuhamilNifas->tgl_laporan_nakes }}" required>
                                @error('tgl_laporan_nakes')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary" onclick="setAction('save')">Simpan</button>
                    <button class="btn btn-default" onclick="history.back()">Kembali Ke List</button>
                </div>
            </form>

            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var statusSelect = document.getElementById('status');
            var fields = {
                'umur_ibu': document.getElementById('umur_ibu'),
                'kelahiran_ke': document.getElementById('kelahiran_ke'),
                'tgl_persalinan': document.getElementById('tgl_persalinan'),
                'pukul_persalinan': document.getElementById('pukul_persalinan'),
                'usia_kehamilan_persalinan': document.getElementById('usia_kehamilan_persalinan'),
                'penolong_persalinan': document.getElementById('penolong_persalinan'),
                'lainya_penolong_persalinan': document.getElementById('lainya_penolong_persalinan'),
                'tmpt_persalinan': document.getElementById('tmpt_persalinan'),
                'nama_tmpt_persalinan': document.getElementById('nama_tmpt_persalinan'),
                'cara_persalinan': document.getElementById('cara_persalinan'),
                'lainya_cara_persalinan': document.getElementById('lainya_cara_persalinan'),
                'keadaan_ibu_persalinan': document.getElementById('keadaan_ibu_persalinan'),
                'riwayat_imd_persalinan': document.getElementById('riwayat_imd_persalinan'),
                'kunjungan': document.getElementById('kunjungan'),
                'tgl_kunjungan': document.getElementById('tgl_kunjungan'),
                'suhu_tubuh': document.getElementById('suhu_tubuh'),
                'buku_ka': document.getElementById('buku_ka'),
                'pemeriksaan_kesehatan': document.getElementById('pemeriksaan_kesehatan'),
                'tgl_pk': document.getElementById('tgl_pk'),
                'tempat_pk': document.getElementById('tempat_pk'),
                'petugas_pk': document.getElementById('petugas_pk'),
                'porsi': document.getElementById('porsi'),
                'ada_kva': document.getElementById('ada_kva'),
                'wkt_minum_kva': document.getElementById('wkt_minum_kva'),
                'menyusui': document.getElementById('menyusui'),
                'kb_pasca_persalinan': document.getElementById('kb_pasca_persalinan'),
                'skrining_kesehatan': document.getElementById('skrining_kesehatan'),
                'skrining_kesehatan_tmp': document.getElementById('skrining_kesehatan_tmp'),
                'skrining_kesehatan_petugas': document.getElementById('skrining_kesehatan_petugas'),
                'edukasi_kunjungan': document.getElementById('edukasi_kunjungan'),
                'demam': document.getElementById('demam'),
                'perasaan': document.getElementById('perasaan'),
                'sakit': document.getElementById('sakit'),
                'pernafasan': document.getElementById('pernafasan'),
                'payudara': document.getElementById('payudara'),
                'sakit_kepala': document.getElementById('sakit_kepala'),
                'pendarahan': document.getElementById('pendarahan'),
                'sakit_bagian_kelamin': document.getElementById('sakit_bagian_kelamin'),
                'keluar_cairan': document.getElementById('keluar_cairan'),
                'pandangan_kabur': document.getElementById('pandangan_kabur'),
                'darah_nifas': document.getElementById('darah_nifas'),
                'keputihan': document.getElementById('keputihan'),
                'jantung_berdebar': document.getElementById('jantung_berdebar'),
                'pengingat_periksa_postu': document.getElementById('pengingat_periksa_postu'),
                'tgl_laporan_nakes': document.getElementById('tgl_laporan_nakes')
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
                    if (isActive && fields[key].value.trim() === '') {
                        fields[key].value = ''; // Hanya menghapus nilai jika statusnya aktif dan nilai tidak kosong
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


        document.addEventListener("DOMContentLoaded", function() {
            function toggleFormFields(selectElement, fieldElement, oldValue) {
                var isActive = selectElement.value === 'lainnya';
                fieldElement.disabled = !isActive;
                if (isActive) {
                    fieldElement.value = oldValue || ''; // Gunakan nilai old jika ada, jika tidak kosongkan
                } else {
                    fieldElement.value = '-';
                }
            }

            // Untuk penolong_persalinan
            var penolongSelect = document.getElementById('penolong_persalinan');
            var lainyaPenolongField = document.getElementById('lainya_penolong_persalinan');
            var penolongOldValue = lainyaPenolongField.getAttribute('data-old');

            function fillLainyaPenolongField() {
                toggleFormFields(penolongSelect, lainyaPenolongField, penolongOldValue);
            }

            penolongSelect.addEventListener('change', fillLainyaPenolongField);
            fillLainyaPenolongField(); // Initial check

            // Untuk cara_persalinan
            var caraSelect = document.getElementById('cara_persalinan');
            var lainyaCaraField = document.getElementById('lainya_cara_persalinan');
            var caraOldValue = lainyaCaraField.getAttribute('data-old');

            function fillLainyaCaraField() {
                toggleFormFields(caraSelect, lainyaCaraField, caraOldValue);
            }

            caraSelect.addEventListener('change', fillLainyaCaraField);
            fillLainyaCaraField(); // Initial check
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
