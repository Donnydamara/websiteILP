@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Update Kunjungan Rumah Bayi') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body" tyle="text-align: center">
            <form action="{{ route('kunjungan_rumah_bayi.updatedetail', ['id' => $kunjunganrumahBayi->id]) }}" method="post"
                id="modal-save-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">Status Kunjungan Rumah Bayi</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status"
                        required>
                        <option value="">Pilih</option>
                        <option value="Ya"
                            {{ old('status') ?? $kunjunganrumahBayi->status === 'Ya' ? 'selected' : '' }}>Ya
                        </option>
                        <option value="Tidak"
                            {{ old('status') ?? $kunjunganrumahBayi->status === 'Tidak' ? 'selected' : '' }}>
                            Tidak</option>
                        <option value="Selesai"
                            {{ old('status') ?? $kunjunganrumahBayi->status === 'Selesai' ? 'selected' : '' }}>
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
                                    value="{{ old('kk', $kk) ?? $kunjunganrumahBayi->kk }}" required readonly>
                                @error('kk')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama">Nama Bayi</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" placeholder="Nama" autocomplete="off"
                                    value="{{ old('nama', $nama) ?? $kunjunganrumahBayi->nama }}" required>
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
                                    value="{{ old('nik', $nik) ?? $kunjunganrumahBayi->nik }}" required>
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
                                    name="tgl_lahir" id="tgl_lahir"
                                    value="{{ old('tgl_lahir') ?? $kunjunganrumahBayi->tgl_lahir }}" required>
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
                                    value="{{ old('tmp_lahir') ?? $kunjunganrumahBayi->tmp_lahir }}" required>
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
                                    <option value="Laki-laki"
                                        {{ (old('gender') ?? $kunjunganrumahBayi->gender) == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan"
                                        {{ (old('gender') ?? $kunjunganrumahBayi->gender) == 'Perempuan' ? 'selected' : '' }}>
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
                                    value="{{ old('kunjungan') ?? $kunjunganrumahBayi->kunjungan }}" required>
                                @error('kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_kunjungan">Tanggal</label>
                                <input type="date" class="form-control @error('tgl_kunjungan') is-invalid @enderror"
                                    name="tgl_kunjungan" id="tgl_kunjungan"
                                    value="{{ old('tgl_kunjungan') ?? $kunjunganrumahBayi->tgl_kunjungan }}" required>
                                @error('tgl_kunjungan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="suhu">Suhu</label>
                                <select class="form-control @error('suhu') is-invalid @enderror" name="suhu"
                                    id="suhu" required>
                                    <option value="<37,5 C"
                                        {{ (old('suhu') ?? $kunjunganrumahBayi->suhu) == '<37,5 C' ? 'selected' : '' }}>
                                        &lt;37,5 C</option>
                                    <option value=">37,5 C"
                                        {{ (old('suhu') ?? $kunjunganrumahBayi->suhu) == '>37,5 C' ? 'selected' : '' }}>
                                        &gt;37,5 C</option>
                                </select>
                                @error('suhu')
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
                                <label for="suhu">Ada Buku KIA</label>
                                <select class="form-control @error('buku_kia') is-invalid @enderror" name="buku_kia"
                                    id="buku_kia" required>
                                    <option value="Ya"
                                        {{ (old('buku_kia') ?? $kunjunganrumahBayi->buku_kia) == 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('buku_kia') ?? $kunjunganrumahBayi->buku_kia) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('buku_kia')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="suhu">ASI Ekslusif</label>
                                <select class="form-control @error('asi') is-invalid @enderror" name="asi"
                                    id="asi" required>
                                    <option value="Ya"
                                        {{ (old('asi') ?? $kunjunganrumahBayi->asi) == 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('asi') ?? $kunjunganrumahBayi->asi) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('asi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lila">LILA < 23,4 cm</label>
                                        <select class="form-control @error('lila') is-invalid @enderror" name="lila"
                                            id="lila" required>
                                            <option value="">Pilih Opsi</option>
                                            <option value="Ada"
                                                {{ $kunjunganrumahBayi->lila == 'Ada' ? 'selected' : '' }}>
                                                Ada
                                            </option>
                                            <option value="Tidak"
                                                {{ $kunjunganrumahBayi->lila == 'Tidak' ? 'selected' : '' }}>
                                                Tidak
                                            </option>
                                        </select>
                                        @error('lila')
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
                                <h5>Tanggal Terakhir Ditimbang Dan Diukur</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_timbang">Tanggal</label>
                                <input type="date" class="form-control @error('tgl_timbang') is-invalid @enderror"
                                    name="tgl_timbang" id="tgl_timbang"
                                    value="{{ old('tgl_timbang') ?? $kunjunganrumahBayi->tgl_timbang }}" required>
                                @error('tgl_timbang')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tmp_timbang">Tempat</label>
                                <select class="form-control @error('tmp_timbang') is-invalid @enderror"
                                    name="tmp_timbang" id="tmp_timbang" required>
                                    <option value="Puskesmas/Postu"
                                        {{ (old('tmp_timbang') ?? $kunjunganrumahBayi->tmp_timbang) == 'Puskesmas/Postu' ? 'selected' : '' }}>
                                        Puskesmas/Postu</option>
                                    <option value="Ponkesdes/Polindes"
                                        {{ (old('tmp_timbang') ?? $kunjunganrumahBayi->tmp_timbang) == 'Ponkesdes/Polindes' ? 'selected' : '' }}>
                                        Ponkesdes/Polindes</option>
                                    <option value="BPM"
                                        {{ (old('tmp_timbang') ?? $kunjunganrumahBayi->tmp_timbang) == 'BPM' ? 'selected' : '' }}>
                                        BPM</option>
                                    <option value="Posyandu"
                                        {{ (old('tmp_timbang') ?? $kunjunganrumahBayi->tmp_timbang) == 'Posyandu' ? 'selected' : '' }}>
                                        Posyandu</option>
                                    <option value="Rumah"
                                        {{ (old('tmp_timbang') ?? $kunjunganrumahBayi->tmp_timbang) == 'Rumah' ? 'selected' : '' }}>
                                        Rumah</option>
                                </select>
                                @error('tmp_timbang')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="petugas_timbang">Petugas</label>
                                <select class="form-control @error('petugas_timbang') is-invalid @enderror"
                                    name="petugas_timbang" id="petugas_timbang" required>
                                    <option value="Bidan"
                                        {{ (old('petugas_timbang') ?? $kunjunganrumahBayi->petugas_timbang) == 'Bidan' ? 'selected' : '' }}>
                                        Bidan</option>
                                    <option value="Perawat"
                                        {{ (old('petugas_timbang') ?? $kunjunganrumahBayi->petugas_timbang) == 'Perawat' ? 'selected' : '' }}>
                                        Perawat</option>
                                    <option value="Kader"
                                        {{ (old('petugas_timbang') ?? $kunjunganrumahBayi->petugas_timbang) == 'Kader' ? 'selected' : '' }}>
                                        Kader</option>
                                </select>
                                @error('petugas_timbang')
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
                                <label for="hasil_timbang_ukur_bb">BB</label>
                                <input type="number"
                                    class="form-control @error('hasil_timbang_ukur_bb') is-invalid @enderror"
                                    name="hasil_timbang_ukur_bb" id="hasil_timbang_ukur_bb" placeholder="BB"
                                    autocomplete="off"
                                    value="{{ old('hasil_timbang_ukur_bb') ?? $kunjunganrumahBayi->hasil_timbang_ukur_bb }}"
                                    required>
                                @error('hasil_timbang_ukur_bb')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hasil_timbang_ukur_pb">PB</label>
                                <input type="number"
                                    class="form-control @error('hasil_timbang_ukur_pb') is-invalid @enderror"
                                    name="hasil_timbang_ukur_pb" id="hasil_timbang_ukur_pb" placeholder="PB"
                                    autocomplete="off"
                                    value="{{ old('hasil_timbang_ukur_pb') ?? $kunjunganrumahBayi->hasil_timbang_ukur_pb }}"
                                    required>
                                @error('hasil_timbang_ukur_pb')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hasil_timbang_ukur_lk">LK</label>
                                <input type="number"
                                    class="form-control @error('hasil_timbang_ukur_lk') is-invalid @enderror"
                                    name="hasil_timbang_ukur_lk" id="hasil_timbang_ukur_lk" placeholder="LK"
                                    autocomplete="off"
                                    value="{{ old('hasil_timbang_ukur_lk') ?? $kunjunganrumahBayi->hasil_timbang_ukur_lk }}"
                                    required>
                                @error('hasil_timbang_ukur_lk')
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
                                <h5>Kunjungan Pemeriksaan Setelah Dilahirkan (0-28 Hari)</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="jenis_kunjungan_pemeriksaan">Jenis Kunjungan/Pemeriksaan</label>
                                <select class="form-control @error('jenis_kunjungan_pemeriksaan') is-invalid @enderror"
                                    name="jenis_kunjungan_pemeriksaan" id="jenis_kunjungan_pemeriksaan" required>
                                    <option value="Pelayanan Esensial (0-6 Jam)"
                                        {{ (old('jenis_kunjungan_pemeriksaan') ?? $kunjunganrumahBayi->jenis_kunjungan_pemeriksaan) == 'Pelayanan Esensial (0-6 Jam)' ? 'selected' : '' }}>
                                        Pelayanan Esensial (0-6 Jam)</option>
                                    <option value="KN 1 (6-48 Jam)"
                                        {{ (old('jenis_kunjungan_pemeriksaan') ?? $kunjunganrumahBayi->jenis_kunjungan_pemeriksaan) == 'KN 1 (6-48 Jam)' ? 'selected' : '' }}>
                                        KN 1 (6-48 Jam)</option>
                                    <option value="KN 2 (3-7 Hari)"
                                        {{ (old('jenis_kunjungan_pemeriksaan') ?? $kunjunganrumahBayi->jenis_kunjungan_pemeriksaan) == 'KN 2 (3-7 Hari)' ? 'selected' : '' }}>
                                        KN 2 (3-7 Hari)</option>
                                    <option value="KN 3 (8 - 28 Hari)"
                                        {{ (old('jenis_kunjungan_pemeriksaan') ?? $kunjunganrumahBayi->jenis_kunjungan_pemeriksaan) == 'KN 3 (8 - 28 Hari)' ? 'selected' : '' }}>
                                        KN 3 (8 - 28 Hari)</option>
                                </select>
                                @error('jenis_kunjungan_pemeriksaan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_pemeriksaan">Tanggal</label>
                                <input type="date" class="form-control @error('tgl_pemeriksaan') is-invalid @enderror"
                                    name="tgl_pemeriksaan" id="tgl_pemeriksaan"
                                    value="{{ old('tgl_pemeriksaan') ?? $kunjunganrumahBayi->tgl_pemeriksaan }}" required>
                                @error('tgl_pemeriksaan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tmp_pemeriksaan">Tempat</label>
                                <input type="text" class="form-control @error('tmp_pemeriksaan') is-invalid @enderror"
                                    name="tmp_pemeriksaan" id="tmp_pemeriksaan" placeholder="Tempat Pemeriksaan"
                                    autocomplete="off"
                                    value="{{ old('tmp_pemeriksaan') ?? $kunjunganrumahBayi->tmp_pemeriksaan }}" required>
                                @error('tmp_pemeriksaan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="petugas_pemeriksaan">Petugas</label>
                                <select class="form-control @error('petugas_pemeriksaan') is-invalid @enderror"
                                    name="petugas_pemeriksaan" id="petugas_pemeriksaan" required>
                                    <option value="" disabled selected>Pilih Petugas Pemeriksaan</option>
                                    <option value="Dokter"
                                        {{ old('petugas_pemeriksaan') ?? $kunjunganrumahBayi->petugas_pemeriksaan == 'Dokter' ? 'selected' : '' }}>
                                        Dokter</option>
                                    <option value="Bidan"
                                        {{ old('petugas_pemeriksaan') ?? $kunjunganrumahBayi->petugas_pemeriksaan == 'Bidan' ? 'selected' : '' }}>
                                        Bidan</option>
                                    <option value="Perawat"
                                        {{ old('petugas_pemeriksaan') ?? $kunjunganrumahBayi->petugas_pemeriksaan == 'Perawat' ? 'selected' : '' }}>
                                        Perawat</option>
                                    <option value="Kader"
                                        {{ old('petugas_pemeriksaan') ?? $kunjunganrumahBayi->petugas_pemeriksaan == 'Kader' ? 'selected' : '' }}>
                                        Kader</option>
                                </select>
                                @error('petugas_pemeriksaan')
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
                                <h5>jenis imunisasi</h5>
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
                                        {{ (old('jenis_imunisasi') ?? $kunjunganrumahBayi->jenis_imunisasi) == 'Usia 0 Bulan' ? 'selected' : '' }}>
                                        Usia 0 Bulan</option>
                                    <option value="Usia 1 Bulan"
                                        {{ (old('jenis_imunisasi') ?? $kunjunganrumahBayi->jenis_imunisasi) == 'Usia 1 Bulan' ? 'selected' : '' }}>
                                        Usia 1 Bulan</option>
                                    <option value="Usia 2 Bulan"
                                        {{ (old('jenis_imunisasi') ?? $kunjunganrumahBayi->jenis_imunisasi) == 'Usia 2 Bulan' ? 'selected' : '' }}>
                                        Usia 2 Bulan</option>
                                    <option value="Usia 3 Bulan"
                                        {{ (old('jenis_imunisasi') ?? $kunjunganrumahBayi->jenis_imunisasi) == 'Usia 3 Bulan' ? 'selected' : '' }}>
                                        Usia 3 Bulan</option>
                                    <option value="Usia 4 Bulan"
                                        {{ (old('jenis_imunisasi') ?? $kunjunganrumahBayi->jenis_imunisasi) == 'Usia 4 Bulan' ? 'selected' : '' }}>
                                        Usia 4 Bulan</option>
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
                                    <label for="hepatitis_b_0bln">Hepatitis B (<24 Jam)</label>
                                            <input type="date"
                                                class="form-control @error('hepatitis_b_0bln') is-invalid @enderror"
                                                name="hepatitis_b_0bln" id="hepatitis_b_0bln"
                                                value="{{ old('hepatitis_b_0bln') ?? $kunjunganrumahBayi->hepatitis_b_0bln }}">
                                            @error('hepatitis_b_0bln')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bcg_0bln">BCG</label>
                                    <input type="date" class="form-control @error('bcg_0bln') is-invalid @enderror"
                                        name="bcg_0bln" id="bcg_0bln"
                                        value="{{ old('bcg_0bln') ?? $kunjunganrumahBayi->bcg_0bln }}">
                                    @error('bcg_0bln')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="polio_tetes_0bln">Polio Tetes 1</label>
                                    <input type="date"
                                        class="form-control @error('polio_tetes_0bln') is-invalid @enderror"
                                        name="polio_tetes_0bln" id="polio_tetes_0bln"
                                        value="{{ old('polio_tetes_0bln') ?? $kunjunganrumahBayi->polio_tetes_0bln }}">
                                    @error('polio_tetes_0bln')
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
                                    <label for="bcg_1bln">BCG</label>
                                    <input type="date" class="form-control @error('bcg_1bln') is-invalid @enderror"
                                        name="bcg_1bln" id="bcg_1bln"
                                        value="{{ old('bcg_1bln') ?? $kunjunganrumahBayi->bcg_1bln }}">
                                    @error('bcg_1bln')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="polio_tetes_1_1bln">Polio Tetes 1</label>
                                    <input type="date"
                                        class="form-control @error('polio_tetes_1_1bln') is-invalid @enderror"
                                        name="polio_tetes_1_1bln" id="polio_tetes_1_1bln"
                                        value="{{ old('polio_tetes_1_1bln') ?? $kunjunganrumahBayi->polio_tetes_1_1bln }}">
                                    @error('polio_tetes_1_1bln')
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
                                    <label for="dpt_hb_hib_1_2bln">DPT HB Hib 1</label>
                                    <input type="date"
                                        class="form-control @error('dpt_hb_hib_1_2bln') is-invalid @enderror"
                                        name="dpt_hb_hib_1_2bln" id="dpt_hb_hib_1_2bln"
                                        value="{{ old('dpt_hb_hib_1_2bln') ?? $kunjunganrumahBayi->dpt_hb_hib_1_2bln }}">
                                    @error('dpt_hb_hib_1_2bln')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="polio_tetes_1_2bln">Polio Tetes 2</label>
                                    <input type="date"
                                        class="form-control @error('polio_tetes_1_2bln') is-invalid @enderror"
                                        name="polio_tetes_1_2bln" id="polio_tetes_1_2bln"
                                        value="{{ old('polio_tetes_1_2bln') ?? $kunjunganrumahBayi->polio_tetes_1_2bln }}">
                                    @error('polio_tetes_1_2bln')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pcv_1_2bln">PCV 1</label>
                                    <input type="date" class="form-control @error('pcv_1_2bln') is-invalid @enderror"
                                        name="pcv_1_2bln" id="pcv_1_2bln"
                                        value="{{ old('pcv_1_2bln') ?? $kunjunganrumahBayi->pcv_1_2bln }}">
                                    @error('pcv_1_2bln')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rv_1_2bln">RV 1</label>
                                    <input type="date" class="form-control @error('rv_1_2bln') is-invalid @enderror"
                                        name="rv_1_2bln" id="rv_1_2bln"
                                        value="{{ old('rv_1_2bln') ?? $kunjunganrumahBayi->rv_1_2bln }}">
                                    @error('rv_1_2bln')
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
                                    <label for="dpt_hb_hib_2_3bln">DPT HB Hib 2</label>
                                    <input type="date"
                                        class="form-control @error('dpt_hb_hib_2_3bln') is-invalid @enderror"
                                        name="dpt_hb_hib_2_3bln" id="dpt_hb_hib_2_3bln"
                                        value="{{ old('dpt_hb_hib_2_3bln') ?? $kunjunganrumahBayi->dpt_hb_hib_2_3bln }}">
                                    @error('dpt_hb_hib_2_3bln')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="polio_tetes_2_3bln">Polio Tetes 3</label>
                                    <input type="date"
                                        class="form-control @error('polio_tetes_2_3bln') is-invalid @enderror"
                                        name="polio_tetes_2_3bln" id="polio_tetes_2_3bln"
                                        value="{{ old('polio_tetes_2_3bln') ?? $kunjunganrumahBayi->polio_tetes_2_3bln }}">
                                    @error('polio_tetes_2_3bln')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pcv_2_3bln">PCV 2</label>
                                    <input type="date" class="form-control @error('pcv_2_3bln') is-invalid @enderror"
                                        name="pcv_2_3bln" id="pcv_2_3bln"
                                        value="{{ old('pcv_2_3bln') ?? $kunjunganrumahBayi->pcv_2_3bln }}">
                                    @error('pcv_2_3bln')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pcv_2_3bln">PCV 2</label>
                                    <input type="date" class="form-control @error('pcv_2_3bln') is-invalid @enderror"
                                        name="pcv_2_3bln" id="pcv_2_3bln"
                                        value="{{ old('pcv_2_3bln') ?? $kunjunganrumahBayi->pcv_2_3bln }}">
                                    @error('pcv_2_3bln')
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
                                    <label for="dpt_hb_hib_3_4bln">DPT HB Hib 3</label>
                                    <input type="date"
                                        class="form-control @error('dpt_hb_hib_3_4bln') is-invalid @enderror"
                                        name="dpt_hb_hib_3_4bln" id="dpt_hb_hib_3_4bln"
                                        value="{{ old('dpt_hb_hib_3_4bln') ?? $kunjunganrumahBayi->dpt_hb_hib_3_4bln }}">
                                    @error('dpt_hb_hib_3_4bln')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="polio_tetes_3_4bln">Polio Tetes 4</label>
                                    <input type="date"
                                        class="form-control @error('polio_tetes_3_4bln') is-invalid @enderror"
                                        name="polio_tetes_3_4bln" id="polio_tetes_3_4bln"
                                        value="{{ old('polio_tetes_3_4bln') ?? $kunjunganrumahBayi->polio_tetes_3_4bln }}">
                                    @error('polio_tetes_3_4bln')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pcv_3_4bln">PCV 3</label>
                                    <input type="date" class="form-control @error('pcv_3_4bln') is-invalid @enderror"
                                        name="pcv_3_4bln" id="pcv_3_4bln"
                                        value="{{ old('pcv_3_4bln') ?? $kunjunganrumahBayi->pcv_3_4bln }}">
                                    @error('pcv_3_4bln')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rv_3_4bln">RV 3</label>
                                    <input type="date" class="form-control @error('rv_3_4bln') is-invalid @enderror"
                                        name="rv_3_4bln" id="rv_3_4bln"
                                        value="{{ old('rv_3_4bln') ?? $kunjunganrumahBayi->rv_3_4bln }}">
                                    @error('rv_3_4bln')
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
                                <h5>Pemberian Edukasi / Kunjungan Nakes</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text"
                                    class="form-control @error('edukasi_kunjungan') is-invalid @enderror"
                                    name="edukasi_kunjungan" id="edukasi_kunjungan" placeholder="Edukasi Kunjungan"
                                    autocomplete="off"
                                    value="{{ old('edukasi_kunjungan') ?? $kunjunganrumahBayi->edukasi_kunjungan }}"
                                    required>
                                @error('edukasi_kunjungan')
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
                                <h5>Tanda Bahaya Pada Bayi 0-2 Bulan</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="napas">Napas</label>
                                <select class="form-control @error('napas') is-invalid @enderror" name="napas"
                                    id="napas" required>
                                    <option value="Ya"
                                        {{ (old('napas') ?? $kunjunganrumahBayi->napas) == 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('napas') ?? $kunjunganrumahBayi->napas) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('napas')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="aktifitas">Aktifitas</label>
                                <select class="form-control @error('aktifitas') is-invalid @enderror" name="aktifitas"
                                    id="aktifitas" required>
                                    <option value="Ya"
                                        {{ (old('aktifitas') ?? $kunjunganrumahBayi->aktifitas) == 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('aktifitas') ?? $kunjunganrumahBayi->aktifitas) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('aktifitas')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="warna_kulit">Warna Kulit</label>
                                <select class="form-control @error('warna_kulit') is-invalid @enderror"
                                    name="warna_kulit" id="warna_kulit" required>
                                    <option value="Ya"
                                        {{ (old('warna_kulit') ?? $kunjunganrumahBayi->warna_kulit) == 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('warna_kulit') ?? $kunjunganrumahBayi->warna_kulit) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('warna_kulit')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hisapan_bayi">Hisapan Bayi</label>
                                <select class="form-control @error('hisapan_bayi') is-invalid @enderror"
                                    name="hisapan_bayi" id="hisapan_bayi" required>
                                    <option value="Ya"
                                        {{ (old('hisapan_bayi') ?? $kunjunganrumahBayi->hisapan_bayi) == 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('hisapan_bayi') ?? $kunjunganrumahBayi->hisapan_bayi) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('hisapan_bayi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kejang">Kejang</label>
                                <select class="form-control @error('kejang') is-invalid @enderror" name="kejang"
                                    id="kejang" required>
                                    <option value="Ya"
                                        {{ (old('kejang') ?? $kunjunganrumahBayi->kejang) == 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('kejang') ?? $kunjunganrumahBayi->kejang) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('kejang')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="suhu_tubuh">Suhu Tubuh</label>
                                <select class="form-control @error('suhu_tubuh') is-invalid @enderror" name="suhu_tubuh"
                                    id="suhu_tubuh" required>
                                    <option value="<37,5 C"
                                        {{ (old('suhu_tubuh') ?? $kunjunganrumahBayi->suhu_tubuh) == '<37,5 C' ? 'selected' : '' }}>
                                        <37,5 C</option>
                                    <option value=">37,5 C"
                                        {{ (old('suhu_tubuh') ?? $kunjunganrumahBayi->suhu_tubuh) == '>37,5 C' ? 'selected' : '' }}>
                                        >37,5 C</option>
                                </select>
                                @error('suhu_tubuh')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bab">Buang Air Besar (BAB)</label>
                                <select class="form-control @error('bab') is-invalid @enderror" name="bab"
                                    id="bab" required>
                                    <option value="Ya"
                                        {{ (old('bab') ?? $kunjunganrumahBayi->bab) == 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('bab') ?? $kunjunganrumahBayi->bab) == 'Tidak' ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>
                                @error('bab')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jmhdanwarna_kencing">Jumlah dan Warna Kencing</label>
                                <select class="form-control @error('jmhdanwarna_kencing') is-invalid @enderror"
                                    name="jmhdanwarna_kencing" id="jmhdanwarna_kencing" required>
                                    <option value="Ya"
                                        {{ (old('jmhdanwarna_kencing') ?? $kunjunganrumahBayi->jmhdanwarna_kencing) == 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('jmhdanwarna_kencing') ?? $kunjunganrumahBayi->jmhdanwarna_kencing) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('jmhdanwarna_kencing')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tali_pusar">Tali Pusar</label>
                                <select class="form-control @error('tali_pusar') is-invalid @enderror" name="tali_pusar"
                                    id="tali_pusar" required>
                                    <option value="Ya"
                                        {{ (old('tali_pusar') ?? $kunjunganrumahBayi->tali_pusar) == 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('tali_pusar') ?? $kunjunganrumahBayi->tali_pusar) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('tali_pusar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mata">Mata</label>
                                <select class="form-control @error('mata') is-invalid @enderror" name="mata"
                                    id="mata" required>
                                    <option value="Ya"
                                        {{ (old('mata') ?? $kunjunganrumahBayi->mata) == 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('mata') ?? $kunjunganrumahBayi->mata) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('mata')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kulit">Kulit</label>
                                <select class="form-control @error('kulit') is-invalid @enderror" name="kulit"
                                    id="kulit" required>
                                    <option value="Ya"
                                        {{ (old('kulit') ?? $kunjunganrumahBayi->kulit) == 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak"
                                        {{ (old('kulit') ?? $kunjunganrumahBayi->kulit) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('kulit')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="imunisasi">Imunisasi</label>
                                <select class="form-control @error('imunisasi') is-invalid @enderror" name="imunisasi"
                                    id="imunisasi" required>
                                    <option value="Ya"
                                        {{ (old('imunisasi') ?? $kunjunganrumahBayi->imunisasi) == 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ (old('imunisasi') ?? $kunjunganrumahBayi->imunisasi) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                                @error('imunisasi')
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
                                <label for="pengingat_pemeriksaan">Pengingat Pemeriksaan</label>
                                <input type="text"
                                    class="form-control @error('pengingat_pemeriksaan') is-invalid @enderror"
                                    name="pengingat_pemeriksaan" id="pengingat_pemeriksaan"
                                    placeholder="Pengingat Pemeriksaan" autocomplete="off"
                                    value="{{ old('pengingat_pemeriksaan') ?? $kunjunganrumahBayi->pengingat_pemeriksaan }}"
                                    required>
                                @error('pengingat_pemeriksaan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_lapor_nakes">Tanggal Lapor Nakes</label>
                                <input type="date" class="form-control @error('tgl_lapor_nakes') is-invalid @enderror"
                                    name="tgl_lapor_nakes" id="tgl_lapor_nakes"
                                    value="{{ old('tgl_lapor_nakes') ?? $kunjunganrumahBayi->tgl_lapor_nakes }}"
                                    required>
                                @error('tgl_lapor_nakes')
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
                // 'nik': document.getElementById('nik'),
                // 'nama': document.getElementById('nama'),
                'tgl_lahir': document.getElementById('tgl_lahir'),
                'tmp_lahir': document.getElementById('tmp_lahir'),
                'gender': document.getElementById('gender'),
                'kunjungan': document.getElementById('kunjungan'),
                'tgl_kunjungan': document.getElementById('tgl_kunjungan'),
                'suhu': document.getElementById('suhu'),
                'buku_kia': document.getElementById('buku_kia'),
                'tgl_timbang': document.getElementById('tgl_timbang'),
                'tmp_timbang': document.getElementById('tmp_timbang'),
                'petugas_timbang': document.getElementById('petugas_timbang'),
                'hasil_timbang_ukur_bb': document.getElementById('hasil_timbang_ukur_bb'),
                'hasil_timbang_ukur_pb': document.getElementById('hasil_timbang_ukur_pb'),
                'hasil_timbang_ukur_lk': document.getElementById('hasil_timbang_ukur_lk'),
                'jenis_kunjungan_pemeriksaan': document.getElementById('jenis_kunjungan_pemeriksaan'),
                'tgl_pemeriksaan': document.getElementById('tgl_pemeriksaan'),
                'tmp_pemeriksaan': document.getElementById('tmp_pemeriksaan'),
                'petugas_pemeriksaan': document.getElementById('petugas_pemeriksaan'),
                // 'jenis_imunisasi': document.getElementById('jenis_imunisasi'),
                'hepatitis_b_0bln': document.getElementById('hepatitis_b_0bln'),
                'bcg_0bln': document.getElementById('bcg_0bln'),
                'polio_tetes_0bln': document.getElementById('polio_tetes_0bln'),
                'bcg_1bln': document.getElementById('bcg_1bln'),
                'polio_tetes_1_1bln': document.getElementById('polio_tetes_1_1bln'),
                'dpt_hb_hib_1_2bln': document.getElementById('dpt_hb_hib_1_2bln'),
                'polio_tetes_1_2bln': document.getElementById('polio_tetes_1_2bln'),
                'pcv_1_2bln': document.getElementById('pcv_1_2bln'),
                'rv_1_2bln': document.getElementById('rv_1_2bln'),
                'dpt_hb_hib_2_3bln': document.getElementById('dpt_hb_hib_2_3bln'),
                'polio_tetes_2_3bln': document.getElementById('polio_tetes_2_3bln'),
                'pcv_2_3bln': document.getElementById('pcv_2_3bln'),
                'rv_2_3bln': document.getElementById('rv_2_3bln'),
                'dpt_hb_hib_3_4bln': document.getElementById('dpt_hb_hib_3_4bln'),
                'polio_tetes_3_4bln': document.getElementById('polio_tetes_3_4bln'),
                'pcv_3_4bln': document.getElementById('pcv_3_4bln'),
                'rv_3_4bln': document.getElementById('rv_3_4bln'),
                'edukasi_kunjungan': document.getElementById('edukasi_kunjungan'),
                'napas': document.getElementById('napas'),
                'aktifitas': document.getElementById('aktifitas'),
                'warna_kulit': document.getElementById('warna_kulit'),
                'hisapan_bayi': document.getElementById('hisapan_bayi'),
                'kejang': document.getElementById('kejang'),
                'suhu_tubuh': document.getElementById('suhu_tubuh'),
                'bab': document.getElementById('bab'),
                'jmhdanwarna_kencing': document.getElementById('jmhdanwarna_kencing'),
                'tali_pusar': document.getElementById('tali_pusar'),
                'mata': document.getElementById('mata'),
                'kulit': document.getElementById('kulit'),
                'imunisasi': document.getElementById('imunisasi'),
                'pengingat_pemeriksaan': document.getElementById('pengingat_pemeriksaan'),
                'tgl_lapor_nakes': document.getElementById('tgl_lapor_nakes')
            };

            // Komentar atau hapus bagian berikut agar tidak mengambil data dari local storage
            /*
            for (var key in fields) {
                var storedValue = localStorage.getItem(key);
                if (storedValue !== null) {
                    fields[key].value = storedValue;
                }
            }
            */

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

        // ===================================================================================

        // var jenisImunisasiSelect = document.getElementById('jenis_imunisasi');
        // var fieldsByImunisasi = {
        //     'Usia 0 Bulan': ['hepatitis_b_0bln', 'bcg_0bln', 'polio_tetes_0bln'],
        //     'Usia 1 Bulan': ['bcg_1bln', 'polio_tetes_1_1bln'],
        //     'Usia 2 Bulan': ['dpt_hb_hib_1_2bln', 'polio_tetes_1_2bln', 'pcv_1_2bln', 'rv_1_2bln'],
        //     'Usia 3 Bulan': ['dpt_hb_hib_2_3bln', 'polio_tetes_2_3bln', 'pcv_2_3bln', 'rv_2_3bln'],
        //     'Usia 4 Bulan': ['dpt_hb_hib_3_4bln', 'polio_tetes_3_4bln', 'pcv_3_4bln', 'rv_3_4bln']
        // };

        // function updateFormFields() {
        //     var selectedImunisasi = jenisImunisasiSelect.value;
        //     var allFields = document.querySelectorAll(
        //         '[id^=hepatitis_b_], [id^=bcg_], [id^=polio_tetes_], [id^=dpt_hb_hib_], [id^=pcv_], [id^=rv_]');

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


        // // Memanggil fungsi untuk memperbarui status formulir saat halaman dimuat dan setiap kali dropdown diubah
        // document.addEventListener('DOMContentLoaded', function() {
        //     updateFormFields();
        //     jenisImunisasiSelect.addEventListener('change', updateFormFields);
        // });
    </script>

    <style>
        .card {
            text - align: center
        }
    </style>
    </script>
@endsection

@section('scripts')
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function setAction(action) {
            // Show SweetAlert2 loading animation
            Swal.fire({
                title: 'simpan...',
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
