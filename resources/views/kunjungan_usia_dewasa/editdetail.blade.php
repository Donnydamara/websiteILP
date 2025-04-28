@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Update kunjunganusia Usia Dewasa') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">

            <form action="{{ route('kunjungan_usia_dewasa.updatedetail', ['id' => $kunjunganusiaDewasa->id]) }}"
                method="post" id="modal-save-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">Status Kunjungan Usia Dewasa</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" required>
                        <option value="">Pilih</option>
                        <option value="Ya"
                            {{ old('status') ?? $kunjunganusiaDewasa->status === 'Ya' ? 'selected' : '' }}>Ya
                        </option>
                        <option value="Tidak"
                            {{ old('status') ?? $kunjunganusiaDewasa->status === 'Tidak' ? 'selected' : '' }}>
                            Tidak</option>
                        <option value="Selesai"
                            {{ old('status') ?? $kunjunganusiaDewasa->status === 'Selesai' ? 'selected' : '' }}>
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
                                <label for="kk">KK</label>
                                <input type="number" class="form-control @error('kk') is-invalid @enderror" name="kk"
                                    id="kk" placeholder="KK" autocomplete="off"
                                    value="{{ old('kk') ?? $kunjunganusiaDewasa->kk }}" required readonly>
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
                                    value="{{ old('nama') ?? $kunjunganusiaDewasa->nama }}" required readonly>
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
                                    value="{{ old('nik') ?? $kunjunganusiaDewasa->nik }}" required readonly>
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
                                    value="{{ old('tgl_lahir') ?? $kunjunganusiaDewasa->tgl_lahir }}" required>
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
                                    autocomplete="off"value="{{ old('tmp_lahir') ?? $kunjunganusiaDewasa->tmp_lahir }}"
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
                                    <option value="Laki-Laki"
                                        {{ (old('gender') ?? $kunjunganusiaDewasa->gender) == 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="Perempuan"
                                        {{ (old('gender') ?? $kunjunganusiaDewasa->gender) == 'Perempuan' ? 'selected' : '' }}>
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
                                <label for="riwayat_penyakit">Riwayat Penyakit Keluarga</label>
                                <select class="form-control @error('riwayat_penyakit') is-invalid @enderror"
                                    name="riwayat_penyakit" id="riwayat_penyakit" required>
                                    <option value="" disabled selected>Pilih Riwayat Penyakit</option>
                                    <option value="Tidak Ada"
                                        {{ (old('riwayat_penyakit') ?? $kunjunganusiaDewasa->riwayat_penyakit) == 'Tidak Ada' ? 'selected' : '' }}>
                                        Tidak Ada</option>
                                    <option value="Hipertensi"
                                        {{ (old('riwayat_penyakit') ?? $kunjunganusiaDewasa->riwayat_penyakit) == 'Hipertensi' ? 'selected' : '' }}>
                                        Hipertensi</option>
                                    <option value="Diabetes Melitus"
                                        {{ (old('riwayat_penyakit') ?? $kunjunganusiaDewasa->riwayat_penyakit) == 'Diabetes Melitus' ? 'selected' : '' }}>
                                        Diabetes Melitus</option>
                                    <option value="Stroke"
                                        {{ (old('riwayat_penyakit') ?? $kunjunganusiaDewasa->riwayat_penyakit) == 'Stroke' ? 'selected' : '' }}>
                                        Stroke</option>
                                    <option value="Jantung"
                                        {{ (old('riwayat_penyakit') ?? $kunjunganusiaDewasa->riwayat_penyakit) == 'Jantung' ? 'selected' : '' }}>
                                        Jantung</option>
                                    <option value="Asma"
                                        {{ (old('riwayat_penyakit') ?? $kunjunganusiaDewasa->riwayat_penyakit) == 'Asma' ? 'selected' : '' }}>
                                        Asma</option>
                                    <option value="Kanker"
                                        {{ (old('riwayat_penyakit') ?? $kunjunganusiaDewasa->riwayat_penyakit) == 'Kanker' ? 'selected' : '' }}>
                                        Kanker</option>
                                    <option value="Kolesterol Tinggi"
                                        {{ (old('riwayat_penyakit') ?? $kunjunganusiaDewasa->riwayat_penyakit) == 'Kolesterol Tinggi' ? 'selected' : '' }}>
                                        Kolesterol Tinggi</option>
                                </select>
                                @error('riwayat_penyakit')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kunjungan">Kunjungan</label>
                                <input type="number" class="form-control @error('kunjungan') is-invalid @enderror"
                                    name="kunjungan" id="kunjungan" placeholder="Kunjungan" autocomplete="off"
                                    value="{{ old('kunjungan') ?? $kunjunganusiaDewasa->kunjungan }}" required>
                                @error('kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_kunjungan">Tanggal Kunjungan</label>
                                <input type="date" class="form-control @error('tgl_kunjungan') is-invalid @enderror"
                                    name="tgl_kunjungan" id="tgl_kunjungan" autocomplete="off"
                                    value="{{ old('tgl_kunjungan') ?? $kunjunganusiaDewasa->tgl_kunjungan }}" required>
                                @error('tgl_kunjungan')
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
                                <label for="suhu_tubuh">Suhu Tubuh</label>
                                <select class="form-control @error('suhu_tubuh') is-invalid @enderror" name="suhu_tubuh"
                                    id="suhu_tubuh" required>
                                    <option value="" disabled selected>Pilih Suhu Tubuh</option>
                                    <option value="<37,5C"
                                        {{ (old('suhu_tubuh') ?? $kunjunganusiaDewasa->suhu_tubuh) == '<37,5C' ? 'selected' : '' }}>
                                        &lt;37,5C</option>
                                    <option value=">37,5C"
                                        {{ (old('suhu_tubuh') ?? $kunjunganusiaDewasa->suhu_tubuh) == '>37,5C' ? 'selected' : '' }}>
                                        &gt;37,5C</option>
                                </select>
                                @error('suhu_tubuh')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="porsi">Porsi</label>
                                <select class="form-control @error('porsi') is-invalid @enderror" name="porsi"
                                    id="porsi" required>
                                    <option value="" disabled selected>Pilih Porsi</option>
                                    <option value="Sesuai"
                                        {{ (old('porsi') ?? $kunjunganusiaDewasa->porsi) == 'Sesuai' ? 'selected' : '' }}>
                                        Sesuai</option>
                                    <option value="Tidak"
                                        {{ (old('porsi') ?? $kunjunganusiaDewasa->porsi) == 'Tidak' ? 'selected' : '' }}>
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
                                <h5>Pemeriksaan Tekanan Darah</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Pemeriksaan Dalam Satu Tahun Terakhir</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_periksa_satu_tahun_terakhir_ptd">Tanggal</label>
                                <input type="date"
                                    class="form-control @error('tgl_periksa_satu_tahun_terakhir_ptd') is-invalid @enderror"
                                    name="tgl_periksa_satu_tahun_terakhir_ptd" id="tgl_periksa_satu_tahun_terakhir_ptd"
                                    value="{{ old('tgl_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganusiaDewasa->tgl_periksa_satu_tahun_terakhir_ptd }}"
                                    required>
                                @error('tgl_periksa_satu_tahun_terakhir_ptd')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tmp_periksa_satu_tahun_terakhir_ptd">Tempat</label>
                                <select
                                    class="form-control @error('tmp_periksa_satu_tahun_terakhir_ptd') is-invalid @enderror"
                                    name="tmp_periksa_satu_tahun_terakhir_ptd" id="tmp_periksa_satu_tahun_terakhir_ptd"
                                    required>
                                    <option value="" disabled selected>Pilih Tempat</option>
                                    <option value="Puskesmas"
                                        {{ (old('tmp_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_terakhir_ptd) == 'Puskesmas' ? 'selected' : '' }}>
                                        Puskesmas</option>
                                    <option value="Polindes"
                                        {{ (old('tmp_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_terakhir_ptd) == 'Polindes' ? 'selected' : '' }}>
                                        Polindes</option>
                                    <option value="Posyandu"
                                        {{ (old('tmp_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_terakhir_ptd) == 'Posyandu' ? 'selected' : '' }}>
                                        Posyandu</option>
                                    <option value="Rumah"
                                        {{ (old('tmp_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_terakhir_ptd) == 'Rumah' ? 'selected' : '' }}>
                                        Rumah</option>
                                    <option value="Lainnya"
                                        {{ (old('tmp_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_terakhir_ptd) == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                                @error('tmp_periksa_satu_tahun_terakhir_ptd')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hasil_periksa_satu_tahun_terakhir_ptd">Hasil</label>
                                <input type="number"
                                    class="form-control @error('hasil_periksa_satu_tahun_terakhir_ptd') is-invalid @enderror"
                                    name="hasil_periksa_satu_tahun_terakhir_ptd"
                                    id="hasil_periksa_satu_tahun_terakhir_ptd"
                                    value="{{ old('hasil_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganusiaDewasa->hasil_periksa_satu_tahun_terakhir_ptd }}"
                                    required>
                                @error('hasil_periksa_satu_tahun_terakhir_ptd')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Terdiagnosa Darah Tinggi / Hipertensi</h5>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="diaknosa_tekanan_darah">Terdiagnosa</label>
                                <select class="form-control @error('diaknosa_tekanan_darah') is-invalid @enderror"
                                    name="diaknosa_tekanan_darah" id="diaknosa_tekanan_darah">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Terdiagnosa"
                                        {{ old('diaknosa_tekanan_darah') == 'Terdiagnosa' || $kunjunganusiaDewasa->diaknosa_tekanan_darah == 'Terdiagnosa' ? 'selected' : '' }}>
                                        Terdiagnosa
                                    </option>
                                    <option value="Tidak Terdiagnosa"
                                        {{ old('diaknosa_tekanan_darah') == 'Tidak Terdiagnosa' || $kunjunganusiaDewasa->diaknosa_tekanan_darah == 'Tidak Terdiagnosa' ? 'selected' : '' }}>
                                        Tidak Terdiagnosa
                                    </option>
                                </select>
                                @error('diaknosa_tekanan_darah')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_diaknosa_darah_ptd">Tanggal</label>
                                <input type="date"
                                    class="form-control @error('tgl_diaknosa_darah_ptd') is-invalid @enderror"
                                    name="tgl_diaknosa_darah_ptd" id="tgl_diaknosa_darah_ptd"
                                    value="{{ old('tgl_diaknosa_darah_ptd') ?? $kunjunganusiaDewasa->tgl_diaknosa_darah_ptd }}">
                                @error('tgl_diaknosa_darah_ptd')
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
                                <h5>Terdiaknosa Tekanan Darah Tinggi / Hiptertensi</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 2%">
                        <div class="row" style="margin: 1%">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Pemeriksaan Dalam Satu Bulan Terakhir</h5>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_periksa_satu_tahun_terakhir_darah">Tanggal Periksa Satu Tahun Terakhir
                                        Darah</label>
                                    <input type="date"
                                        class="form-control @error('tgl_periksa_satu_tahun_terakhir_darah') is-invalid @enderror"
                                        name="tgl_periksa_satu_tahun_terakhir_darah"
                                        id="tgl_periksa_satu_tahun_terakhir_darah"
                                        value="{{ old('tgl_periksa_satu_tahun_terakhir_darah') ?? $kunjunganusiaDewasa->tgl_periksa_satu_tahun_terakhir_darah }}">
                                    @error('tgl_periksa_satu_tahun_terakhir_darah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tmp_periksa_satu_tahun_terakhir_darah">Tempat</label>
                                    <select
                                        class="form-control @error('tmp_periksa_satu_tahun_terakhir_darah') is-invalid @enderror"
                                        name="tmp_periksa_satu_tahun_terakhir_darah"
                                        id="tmp_periksa_satu_tahun_terakhir_darah" required>
                                        <option value="" disabled selected>Pilih Tempat</option>
                                        <option value="Puskesmas"
                                            {{ (old('tmp_periksa_satu_tahun_terakhir_darah') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_terakhir_darah) == 'Puskesmas' ? 'selected' : '' }}>
                                            Puskesmas</option>
                                        <option value="Polindes"
                                            {{ (old('tmp_periksa_satu_tahun_terakhir_darah') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_terakhir_darah) == 'Polindes' ? 'selected' : '' }}>
                                            Polindes</option>
                                        <option value="Posyandu"
                                            {{ (old('tmp_periksa_satu_tahun_terakhir_darah') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_terakhir_darah) == 'Posyandu' ? 'selected' : '' }}>
                                            Posyandu</option>
                                        <option value="Lainnya"
                                            {{ (old('tmp_periksa_satu_tahun_terakhir_darah') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_terakhir_darah) == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('tmp_periksa_satu_tahun_terakhir_darah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hasil_periksa_satu_tahun_terakhir_darah">Hasil Periksa Satu Tahun Terakhir
                                        Darah</label>
                                    <input type="number"
                                        class="form-control @error('hasil_periksa_satu_tahun_terakhir_darah') is-invalid @enderror"
                                        name="hasil_periksa_satu_tahun_terakhir_darah"
                                        id="hasil_periksa_satu_tahun_terakhir_darah"
                                        value="{{ old('hasil_periksa_satu_tahun_terakhir_darah') ?? $kunjunganusiaDewasa->hasil_periksa_satu_tahun_terakhir_darah }}">
                                    @error('hasil_periksa_satu_tahun_terakhir_darah')
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
                                    <label for="tgl_periksa_satu_tahun_gula_darah">Ada Obat Hipertensi</label>
                                    <select class="form-control @error('obat_terakhir_darah') is-invalid @enderror"
                                        name="obat_terakhir_darah" id="obat_terakhir_darah" required>
                                        <option value="" disabled selected>Pilih Obat Terakhir Darah</option>
                                        <option value="Ada"
                                            {{ (old('obat_terakhir_darah') ?? $kunjunganusiaDewasa->obat_terakhir_darah) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak"
                                            {{ (old('obat_terakhir_darah') ?? $kunjunganusiaDewasa->obat_terakhir_darah) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('obat_terakhir_darah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minum_obat_terakhir_darah">Pemeriksaan Dalam Satu Bulan Terakhir</label>
                                    <select class="form-control @error('minum_obat_terakhir_darah') is-invalid @enderror"
                                        name="minum_obat_terakhir_darah" id="minum_obat_terakhir_darah" required>
                                        <option value="" disabled selected>Pilih Minum Obat Terakhir Darah</option>
                                        <option value="Ya"
                                            {{ (old('minum_obat_terakhir_darah') ?? $kunjunganusiaDewasa->minum_obat_terakhir_darah) == 'Ya' ? 'selected' : '' }}>
                                            Ya</option>
                                        <option value="Tidak"
                                            {{ (old('minum_obat_terakhir_darah') ?? $kunjunganusiaDewasa->minum_obat_terakhir_darah) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('minum_obat_terakhir_darah')
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
                                <h5>Pemeriksaan Kadar Gula Darah</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 2%">
                        <div class="row" style="margin: 1%">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Pemeriksaan Dalam Satu Tahun Terakhir</h5>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_periksa_satu_tahun_gula_darah">Tanggal</label>
                                    <input type="date"
                                        class="form-control @error('tgl_periksa_satu_tahun_gula_darah') is-invalid @enderror"
                                        name="tgl_periksa_satu_tahun_gula_darah" id="tgl_periksa_satu_tahun_gula_darah"
                                        value="{{ old('tgl_periksa_satu_tahun_gula_darah') ?? $kunjunganusiaDewasa->tgl_periksa_satu_tahun_gula_darah }}">
                                    @error('tgl_periksa_satu_tahun_gula_darah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tmp_periksa_satu_tahun_gula_darah">Tempat</label>
                                    <select
                                        class="form-control @error('tmp_periksa_satu_tahun_gula_darah') is-invalid @enderror"
                                        name="tmp_periksa_satu_tahun_gula_darah" id="tmp_periksa_satu_tahun_gula_darah"
                                        required>
                                        <option value="" disabled selected>Pilih Tempat</option>
                                        <option value="Puskesmas"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_gula_darah) == 'Puskesmas' ? 'selected' : '' }}>
                                            Puskesmas</option>
                                        <option value="Polindes"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_gula_darah) == 'Polindes' ? 'selected' : '' }}>
                                            Polindes</option>
                                        <option value="Posyandu"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_gula_darah) == 'Posyandu' ? 'selected' : '' }}>
                                            Posyandu</option>
                                        <option value="Rumah"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_gula_darah) == 'Rumah' ? 'selected' : '' }}>
                                            Rumah</option>
                                        <option value="Lainnya"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_gula_darah) == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('tmp_periksa_satu_tahun_gula_darah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hasil_periksa_satu_tahun_gula_darah">Hasil</label>
                                    <input type="number"
                                        class="form-control @error('hasil_periksa_satu_tahun_gula_darah') is-invalid @enderror"
                                        name="hasil_periksa_satu_tahun_gula_darah"
                                        id="hasil_periksa_satu_tahun_gula_darah"
                                        value="{{ old('hasil_periksa_satu_tahun_gula_darah') ?? $kunjunganusiaDewasa->hasil_periksa_satu_tahun_gula_darah }}">
                                    @error('hasil_periksa_satu_tahun_gula_darah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Terdiagnosa Kencing Manis / Diabetes Melitus (DM)</h5>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="diaknosa_gula_darah">Terdiagnosa</label>
                                    <select class="form-control @error('diaknosa_gula_darah') is-invalid @enderror"
                                        name="diaknosa_gula_darah" id="diaknosa_gula_darah">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Terdiagnosa"
                                            {{ old('diaknosa_gula_darah') == 'Terdiagnosa' || $kunjunganusiaDewasa->diaknosa_gula_darah == 'Terdiagnosa' ? 'selected' : '' }}>
                                            Terdiagnosa
                                        </option>
                                        <option value="Tidak Terdiagnosa"
                                            {{ old('diaknosa_gula_darah') == 'Tidak Terdiagnosa' || $kunjunganusiaDewasa->diaknosa_gula_darah == 'Tidak Terdiagnosa' ? 'selected' : '' }}>
                                            Tidak Terdiagnosa
                                        </option>
                                    </select>
                                    @error('diaknosa_gula_darah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_kencing_manis_gula_darah">Tanggal Terdiagnosa</label>
                                    <input type="date"
                                        class="form-control @error('tgl_kencing_manis_gula_darah') is-invalid @enderror"
                                        name="tgl_kencing_manis_gula_darah" id="tgl_kencing_manis_gula_darah"
                                        value="{{ old('tgl_kencing_manis_gula_darah') ?? $kunjunganusiaDewasa->tgl_kencing_manis_gula_darah }}">
                                    @error('tgl_kencing_manis_gula_darah')
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
                                <h5>Terdiaknosa Gula Darah Tinggi / Diabetes Melitus</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 2%">
                        <div class="row" style="margin: 1%">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Pemeriksaan Dalam Satu Bulan Terakhir</h5>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_periksa_satu_tahun_gula_darah_melitus">Tanggal</label>
                                    <input type="date"
                                        class="form-control @error('tgl_periksa_satu_tahun_gula_darah_melitus') is-invalid @enderror"
                                        name="tgl_periksa_satu_tahun_gula_darah_melitus"
                                        id="tgl_periksa_satu_tahun_gula_darah_melitus"
                                        value="{{ old('tgl_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganusiaDewasa->tgl_periksa_satu_tahun_gula_darah_melitus }}">
                                    @error('tgl_periksa_satu_tahun_gula_darah_melitus')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tmp_periksa_satu_tahun_gula_darah_melitus">Tempat</label>
                                    <select
                                        class="form-control @error('tmp_periksa_satu_tahun_gula_darah_melitus') is-invalid @enderror"
                                        name="tmp_periksa_satu_tahun_gula_darah_melitus"
                                        id="tmp_periksa_satu_tahun_gula_darah_melitus" required>
                                        <option value="" disabled selected>Pilih Tempat</option>
                                        <option value="Puskesmas"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_gula_darah_melitus) == 'Puskesmas' ? 'selected' : '' }}>
                                            Puskesmas</option>
                                        <option value="Polindes"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_gula_darah_melitus) == 'Polindes' ? 'selected' : '' }}>
                                            Polindes</option>
                                        <option value="Posyandu"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_gula_darah_melitus) == 'Posyandu' ? 'selected' : '' }}>
                                            Posyandu</option>
                                        <option value="Rumah"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_gula_darah_melitus) == 'Rumah' ? 'selected' : '' }}>
                                            Rumah</option>
                                        <option value="Lainnya"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganusiaDewasa->tmp_periksa_satu_tahun_gula_darah_melitus) == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('tmp_periksa_satu_tahun_gula_darah_melitus')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hasil_periksa_satu_tahun_gula_darah_melitus">Hasil</label>
                                    <input type="number"
                                        class="form-control @error('hasil_periksa_satu_tahun_gula_darah_melitus') is-invalid @enderror"
                                        name="hasil_periksa_satu_tahun_gula_darah_melitus"
                                        id="hasil_periksa_satu_tahun_gula_darah_melitus"
                                        value="{{ old('hasil_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganusiaDewasa->hasil_periksa_satu_tahun_gula_darah_melitus }}">
                                    @error('hasil_periksa_satu_tahun_gula_darah_melitus')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="obat_gula_darah_melitus">Obat Gula DM</label>
                                    <select class="form-control @error('obat_gula_darah_melitus') is-invalid @enderror"
                                        name="obat_gula_darah_melitus" id="obat_gula_darah_melitus" required>
                                        <option value="" disabled selected>Pilih
                                        </option>
                                        <option value="Ada"
                                            {{ old('obat_gula_darah_melitus') ?? $kunjunganusiaDewasa->obat_gula_darah_melitus == 'Ada' ? 'selected' : '' }}>
                                            Ada
                                        </option>
                                        <option value="Tidak"
                                            {{ old('obat_gula_darah_melitus') ?? $kunjunganusiaDewasa->obat_gula_darah_melitus == 'Tidak' ? 'selected' : '' }}>
                                            Tidak
                                        </option>
                                    </select>
                                    @error('obat_gula_darah_melitus')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                div class="form-group">
                                <label for="minum_obat_gula_darah_melitus">Sudah Minum Obat Hari Ini / 24
                                    Jam</label>
                                <select class="form-control @error('minum_obat_gula_darah_melitus') is-invalid @enderror"
                                    name="minum_obat_gula_darah_melitus" id="minum_obat_gula_darah_melitus" required>
                                    <option value="" disabled selected>Pilih
                                    </option>
                                    <option value="Ada"
                                        {{ old('minum_obat_gula_darah_melitus') ?? $kunjunganusiaDewasa->minum_obat_gula_darah_melitus == 'Ada' ? 'selected' : '' }}>
                                        Ada
                                    </option>
                                    <option value="Tidak"
                                        {{ old('minum_obat_gula_darah_melitus') ?? $kunjunganusiaDewasa->minum_obat_gula_darah_melitus == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('minum_obat_gula_darah_melitus')
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
                        <label for="merokok">Merokok</label>
                        <select class="form-control @error('merokok') is-invalid @enderror" name="merokok"
                            id="merokok" required>
                            <option value="" disabled selected>Pilih Status Merokok</option>
                            <option value="Aktif"
                                {{ (old('merokok') ?? $kunjunganusiaDewasa->merokok) == 'Aktif' ? 'selected' : '' }}>
                                Aktif</option>
                            <option value="Pasif"
                                {{ (old('merokok') ?? $kunjunganusiaDewasa->merokok) == 'Pasif' ? 'selected' : '' }}>
                                Pasif</option>
                        </select>
                        @error('merokok')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jenis_kontrasepsi">Jenis Kontrasepsi</label>
                        <select class="form-control @error('jenis_kontrasepsi') is-invalid @enderror"
                            name="jenis_kontrasepsi" id="jenis_kontrasepsi" required>
                            <option value="">Pilih Jenis Kontrasepsi</option>
                            <option value="MOW/MAP"
                                {{ (old('jenis_kontrasepsi') ?? $kunjunganusiaDewasa->jenis_kontrasepsi) === 'MOW/MAP' ? 'selected' : '' }}>
                                MOW/MAP</option>
                            <option value="IUD"
                                {{ (old('jenis_kontrasepsi') ?? $kunjunganusiaDewasa->jenis_kontrasepsi) === 'IUD' ? 'selected' : '' }}>
                                IUD</option>
                            <option value="Implan"
                                {{ (old('jenis_kontrasepsi') ?? $kunjunganusiaDewasa->jenis_kontrasepsi) === 'Implan' ? 'selected' : '' }}>
                                Implan</option>
                            <option value="Suntik"
                                {{ (old('jenis_kontrasepsi') ?? $kunjunganusiaDewasa->jenis_kontrasepsi) === 'Suntik' ? 'selected' : '' }}>
                                Suntik</option>
                            <option value="Pil"
                                {{ (old('jenis_kontrasepsi') ?? $kunjunganusiaDewasa->jenis_kontrasepsi) === 'Pil' ? 'selected' : '' }}>
                                Pil</option>
                            <option value="Komdom"
                                {{ (old('jenis_kontrasepsi') ?? $kunjunganusiaDewasa->jenis_kontrasepsi) === 'Komdom' ? 'selected' : '' }}>
                                Komdom</option>
                            <option value="Komdom"
                                {{ (old('jenis_kontrasepsi') ?? $kunjunganusiaDewasa->jenis_kontrasepsi) === 'Komdom' ? 'selected' : '' }}>
                                Tidak</option>
                        </select>
                        @error('jenis_kontrasepsi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tgl_skrining">Tanggal Skrining</label>
                        <input type="date" class="form-control @error('tgl_skrining') is-invalid @enderror"
                            name="tgl_skrining" id="tgl_skrining"
                            value="{{ old('tgl_skrining') ?? $kunjunganusiaDewasa->tgl_skrining }}">
                        @error('tgl_skrining')
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tmp_skrining">Tempat</label>
                        <select class="form-control @error('tmp_skrining') is-invalid @enderror" name="tmp_skrining"
                            id="tmp_skrining" required>
                            <option value="Puskesmas/Postu"
                                {{ (old('tmp_skrining') ?? $kunjunganusiaDewasa->tmp_skrining) == 'Puskesmas/Postu' ? 'selected' : '' }}>
                                Puskesmas/Postu</option>
                            <option value="Ponkesdes/Polindes"
                                {{ (old('tmp_skrining') ?? $kunjunganusiaDewasa->tmp_skrining) == 'Ponkesdes/Polindes' ? 'selected' : '' }}>
                                Ponkesdes/Polindes</option>
                            <option value="BPM"
                                {{ (old('tmp_skrining') ?? $kunjunganusiaDewasa->tmp_skrining) == 'BPM' ? 'selected' : '' }}>
                                BPM</option>
                            <option value="Posyandu"
                                {{ (old('tmp_skrining') ?? $kunjunganusiaDewasa->tmp_skrining) == 'Posyandu' ? 'selected' : '' }}>
                                Posyandu</option>
                            <option value="Rumah"
                                {{ (old('tmp_skrining') ?? $kunjunganusiaDewasa->tmp_skrining) == 'Rumah' ? 'selected' : '' }}>
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
                        <select class="form-control @error('petugas_skrining') is-invalid @enderror"
                            name="petugas_skrining" id="petugas_skrining" required>
                            <option value="" disabled selected>Pilih</option>
                            <option value="Petugas Kesehatan"
                                {{ (old('petugas_skrining') ?? $kunjunganusiaDewasa->petugas_skrining) == 'Petugas Kesehatan' ? 'selected' : '' }}>
                                Petugas Kesehatan</option>
                            <option value="Kader"
                                {{ (old('petugas_skrining') ?? $kunjunganusiaDewasa->petugas_skrining) == 'Kader' ? 'selected' : '' }}>
                                Kader</option>
                        </select>
                        @error('petugas_skrining')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="edukasi">Edukasi</label>
                        <input type="text" class="form-control @error('edukasi') is-invalid @enderror" name="edukasi"
                            id="edukasi" value="{{ old('edukasi') ?? $kunjunganusiaDewasa->edukasi }}">
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
            var diaknosa_gula_darahSelect = document.getElementById('diaknosa_gula_darah');
            var diaknosa_tekanan_darahSelect = document.getElementById('diaknosa_tekanan_darah');
            var form = document.getElementById('modal-save-form');

            var fields = {
                'kk': document.getElementById('kk'),
                'diaknosa_gula_darah': diaknosa_gula_darahSelect,
                'diaknosa_tekanan_darah': diaknosa_tekanan_darahSelect,
                'nik': document.getElementById('nik'),
                'nama': document.getElementById('nama'),
                'tgl_lahir': document.getElementById('tgl_lahir'),
                'tmp_lahir': document.getElementById('tmp_lahir'),
                'gender': document.getElementById('gender'),
                'riwayat_penyakit': document.getElementById('riwayat_penyakit'),
                'kunjungan': document.getElementById('kunjungan'),
                'tgl_kunjungan': document.getElementById('tgl_kunjungan'),
                'suhu_tubuh': document.getElementById('suhu_tubuh'),
                'porsi': document.getElementById('porsi'),
                'tgl_periksa_satu_tahun_terakhir_ptd': document.getElementById(
                    'tgl_periksa_satu_tahun_terakhir_ptd'),
                'tmp_periksa_satu_tahun_terakhir_ptd': document.getElementById(
                    'tmp_periksa_satu_tahun_terakhir_ptd'),
                'hasil_periksa_satu_tahun_terakhir_ptd': document.getElementById(
                    'hasil_periksa_satu_tahun_terakhir_ptd'),
                'tgl_diaknosa_darah_ptd': document.getElementById('tgl_diaknosa_darah_ptd'),
                'tgl_periksa_satu_tahun_terakhir_darah': document.getElementById(
                    'tgl_periksa_satu_tahun_terakhir_darah'),
                'tmp_periksa_satu_tahun_terakhir_darah': document.getElementById(
                    'tmp_periksa_satu_tahun_terakhir_darah'),
                'hasil_periksa_satu_tahun_terakhir_darah': document.getElementById(
                    'hasil_periksa_satu_tahun_terakhir_darah'),
                'obat_terakhir_darah': document.getElementById('obat_terakhir_darah'),
                'minum_obat_terakhir_darah': document.getElementById('minum_obat_terakhir_darah'),
                'tgl_periksa_satu_tahun_gula_darah': document.getElementById(
                    'tgl_periksa_satu_tahun_gula_darah'),
                'tmp_periksa_satu_tahun_gula_darah': document.getElementById(
                    'tmp_periksa_satu_tahun_gula_darah'),
                'hasil_periksa_satu_tahun_gula_darah': document.getElementById(
                    'hasil_periksa_satu_tahun_gula_darah'),
                'tgl_kencing_manis_gula_darah': document.getElementById('tgl_kencing_manis_gula_darah'),
                'tgl_periksa_satu_tahun_gula_darah_melitus': document.getElementById(
                    'tgl_periksa_satu_tahun_gula_darah_melitus'),
                'tmp_periksa_satu_tahun_gula_darah_melitus': document.getElementById(
                    'tmp_periksa_satu_tahun_gula_darah_melitus'),
                'hasil_periksa_satu_tahun_gula_darah_melitus': document.getElementById(
                    'hasil_periksa_satu_tahun_gula_darah_melitus'),
                'obat_gula_darah_melitus': document.getElementById('obat_gula_darah_melitus'),
                'minum_obat_gula_darah_melitus': document.getElementById('minum_obat_gula_darah_melitus'),
                'merokok': document.getElementById('merokok'),
                'jenis_kontrasepsi': document.getElementById('jenis_kontrasepsi'),
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

            // Specific field toggles based on diagnosis
            function togglediaknosa_gula_darahSpecificFields() {
                var isTerdiagnosa = diaknosa_gula_darahSelect.value === 'Terdiagnosa';
                var gulaDarahFields = [
                    'tgl_kencing_manis_gula_darah',
                    'tgl_periksa_satu_tahun_gula_darah_melitus',
                    'tmp_periksa_satu_tahun_gula_darah_melitus',
                    'hasil_periksa_satu_tahun_gula_darah_melitus',
                    'obat_gula_darah_melitus',
                    'minum_obat_gula_darah_melitus'
                ];

                gulaDarahFields.forEach(function(key) {
                    if (isTerdiagnosa) {
                        fields[key].removeAttribute('disabled');
                    } else {
                        fields[key].setAttribute('disabled', 'disabled');
                        fields[key].value = ''; // Clear value if not diagnosed
                    }
                });
            }

            function togglediaknosa_tekanan_darahSpecificFields() {
                var isTerdiagnosa = diaknosa_tekanan_darahSelect.value === 'Terdiagnosa';
                var tekananDarahFields = [
                    'tgl_diaknosa_darah_ptd',
                    'tgl_periksa_satu_tahun_terakhir_darah',
                    'tmp_periksa_satu_tahun_terakhir_darah',
                    'hasil_periksa_satu_tahun_terakhir_darah',
                    'obat_terakhir_darah',
                    'minum_obat_terakhir_darah'
                ];

                tekananDarahFields.forEach(function(key) {
                    if (isTerdiagnosa) {
                        fields[key].removeAttribute('disabled');
                    } else {
                        fields[key].setAttribute('disabled', 'disabled');
                        fields[key].value = ''; // Clear value if not diagnosed
                    }
                });
            }

            diaknosa_gula_darahSelect.addEventListener('change', togglediaknosa_gula_darahSpecificFields);
            diaknosa_tekanan_darahSelect.addEventListener('change', togglediaknosa_tekanan_darahSpecificFields);

            // Initial checks
            togglediaknosa_gula_darahSpecificFields();
            togglediaknosa_tekanan_darahSpecificFields();

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
