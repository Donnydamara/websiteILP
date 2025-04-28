@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Update kunjungan Lansia') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">

            <form action="{{ route('kunjungan_lansia.updatedetail', ['id' => $kunjunganLansia->id]) }}" method="post"
                id="modal-save-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">Status Kunjungan Lansia</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" required>
                        <option value="">Pilih</option>
                        <option value="Ya" {{ old('status') ?? $kunjunganLansia->status === 'Ya' ? 'selected' : '' }}>Ya
                        </option>
                        <option value="Tidak"
                            {{ old('status') ?? $kunjunganLansia->status === 'Tidak' ? 'selected' : '' }}>
                            Tidak</option>
                        <option value="Selesai"
                            {{ old('status') ?? $kunjunganLansia->status === 'Selesai' ? 'selected' : '' }}>
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
                                    value="{{ old('kk') ?? $kunjunganLansia->kk }}" required readonly>
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
                                    value="{{ old('nama') ?? $kunjunganLansia->nama }}" required readonly>
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
                                    value="{{ old('nik') ?? $kunjunganLansia->nik }}" required readonly>
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
                                    value="{{ old('tgl_lahir') ?? $kunjunganLansia->tgl_lahir }}" required>
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
                                    autocomplete="off"value="{{ old('tmp_lahir') ?? $kunjunganLansia->tmp_lahir }}"
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
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki"
                                        {{ (old('gender') ?? $kunjunganLansia->gender) == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan"
                                        {{ (old('gender') ?? $kunjunganLansia->gender) == 'Perempuan' ? 'selected' : '' }}>
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
                                    value="{{ old('kunjungan') ?? $kunjunganLansia->kunjungan }}" required>
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
                                    value="{{ old('tgl_kunjungan') ?? $kunjunganLansia->tgl_kunjungan }}" required>
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
                                    <option value="" disabled selected>Pilih Pemantauan Suhu Tubuh</option>
                                    <option value="<37,5C"
                                        {{ (old('suhu_tubuh') ?? $kunjunganLansia->suhu_tubuh) == '<37,5C' ? 'selected' : '' }}>
                                        <37,5C< /option>
                                    <option value=">37,5C"
                                        {{ (old('suhu_tubuh') ?? $kunjunganLansia->suhu_tubuh) == '>37,5C' ? 'selected' : '' }}>
                                        >37,5C</option>
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
                                <h5>Pemeriksaan Tekanan Darah</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin: 2% ">
                        <div class="col-md-12">
                            <div class="form-group" style="margin-top: 1%">
                                <div class="form-group">
                                    <h5>Pemeriksaan Dalam Satu Tahun Terakhir</h5>
                                </div>
                            </div>
                            <div class="row" style="margin: 1%">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tgl_periksa_satu_tahun_terakhir_ptd">Tanggal</label>
                                        <input type="date"
                                            class="form-control @error('tgl_periksa_satu_tahun_terakhir_ptd') is-invalid @enderror"
                                            name="tgl_periksa_satu_tahun_terakhir_ptd"
                                            id="tgl_periksa_satu_tahun_terakhir_ptd"
                                            value="{{ old('tgl_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganLansia->tgl_periksa_satu_tahun_terakhir_ptd }}"
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
                                            name="tmp_periksa_satu_tahun_terakhir_ptd"
                                            id="tmp_periksa_satu_tahun_terakhir_ptd" required>
                                            <option value="" disabled selected>Pilih Tempat</option>
                                            <option value="Puskesmas"
                                                {{ (old('tmp_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganLansia->tmp_periksa_satu_tahun_terakhir_ptd) == 'Puskesmas' ? 'selected' : '' }}>
                                                Puskesmas</option>
                                            <option value="Polindes"
                                                {{ (old('tmp_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganLansia->tmp_periksa_satu_tahun_terakhir_ptd) == 'Polindes' ? 'selected' : '' }}>
                                                Polindes</option>
                                            <option value="Posyandu"
                                                {{ (old('tmp_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganLansia->tmp_periksa_satu_tahun_terakhir_ptd) == 'Posyandu' ? 'selected' : '' }}>
                                                Posyandu</option>
                                            <option value="Rumah"
                                                {{ (old('tmp_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganLansia->tmp_periksa_satu_tahun_terakhir_ptd) == 'Rumah' ? 'selected' : '' }}>
                                                Rumah</option>
                                            <option value="Lainnya"
                                                {{ (old('tmp_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganLansia->tmp_periksa_satu_tahun_terakhir_ptd) == 'Lainnya' ? 'selected' : '' }}>
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
                                            value="{{ old('hasil_periksa_satu_tahun_terakhir_ptd') ?? $kunjunganLansia->hasil_periksa_satu_tahun_terakhir_ptd }}"
                                            required>
                                        @error('hasil_periksa_satu_tahun_terakhir_ptd')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Terdiagnosa Darah Tinggi / Hipertensi</h5>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tgl_diaknosa_darah_ptd">Tanggal</label>
                                    <input type="date"
                                        class="form-control @error('tgl_diaknosa_darah_ptd') is-invalid @enderror"
                                        name="tgl_diaknosa_darah_ptd" id="tgl_diaknosa_darah_ptd"
                                        value="{{ old('tgl_diaknosa_darah_ptd') ?? $kunjunganLansia->tgl_diaknosa_darah_ptd }}">
                                    @error('tgl_diaknosa_darah_ptd')
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
                                <h5>Terdiagnosa Tekanan Darah Tinggi / Hipertensi</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin: 2% ">
                        <div class="col-md-12">
                            <div class="form-group" style="margin-top: 1%">
                                <h5>Pemeriksaan Dalam Satu Bulan Terakhir</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_periksa_satu_tahun_terakhir_darah">Tanggal</label>
                                    <input type="date"
                                        class="form-control @error('tgl_periksa_satu_tahun_terakhir_darah') is-invalid @enderror"
                                        name="tgl_periksa_satu_tahun_terakhir_darah"
                                        id="tgl_periksa_satu_tahun_terakhir_darah"
                                        value="{{ old('tgl_periksa_satu_tahun_terakhir_darah') ?? $kunjunganLansia->tgl_periksa_satu_tahun_terakhir_darah }}">
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
                                            {{ (old('tmp_periksa_satu_tahun_terakhir_darah') ?? $kunjunganLansia->tmp_periksa_satu_tahun_terakhir_darah) == 'Puskesmas' ? 'selected' : '' }}>
                                            Puskesmas</option>
                                        <option value="Polindes"
                                            {{ (old('tmp_periksa_satu_tahun_terakhir_darah') ?? $kunjunganLansia->tmp_periksa_satu_tahun_terakhir_darah) == 'Polindes' ? 'selected' : '' }}>
                                            Polindes</option>
                                        <option value="Posyandu"
                                            {{ (old('tmp_periksa_satu_tahun_terakhir_darah') ?? $kunjunganLansia->tmp_periksa_satu_tahun_terakhir_darah) == 'Posyandu' ? 'selected' : '' }}>
                                            Posyandu</option>
                                        <option value="Rumah"
                                            {{ (old('tmp_periksa_satu_tahun_terakhir_darah') ?? $kunjunganLansia->tmp_periksa_satu_tahun_terakhir_darah) == 'Rumah' ? 'selected' : '' }}>
                                            Rumah</option>
                                        <option value="Lainnya"
                                            {{ (old('tmp_periksa_satu_tahun_terakhir_darah') ?? $kunjunganLansia->tmp_periksa_satu_tahun_terakhir_darah) == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('tmp_periksa_satu_tahun_terakhir_darah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hasil_periksa_satu_tahun_terakhir_darah">Hasil</label>
                                    <input type="number"
                                        class="form-control @error('hasil_periksa_satu_tahun_terakhir_darah') is-invalid @enderror"
                                        name="hasil_periksa_satu_tahun_terakhir_darah"
                                        id="hasil_periksa_satu_tahun_terakhir_darah"
                                        value="{{ old('hasil_periksa_satu_tahun_terakhir_darah') ?? $kunjunganLansia->hasil_periksa_satu_tahun_terakhir_darah }}">
                                    @error('hasil_periksa_satu_tahun_terakhir_darah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="obat_terakhir_darah">Ada Obat Hipertensi</label>
                                    <select class="form-control @error('obat_terakhir_darah') is-invalid @enderror"
                                        name="obat_terakhir_darah" id="obat_terakhir_darah">
                                        <option value="" disabled selected>Pilih</option>
                                        <option value="Ada"
                                            {{ (old('obat_terakhir_darah') ?? $kunjunganLansia->obat_terakhir_darah) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak"
                                            {{ (old('obat_terakhir_darah') ?? $kunjunganLansia->obat_terakhir_darah) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('obat_terakhir_darah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minum_obat_terakhir_darah">Minum Obat Terakhir Darah</label>
                                    <select class="form-control @error('minum_obat_terakhir_darah') is-invalid @enderror"
                                        name="minum_obat_terakhir_darah" id="minum_obat_terakhir_darah">
                                        <option value="" disabled selected>Pilih</option>
                                        <option value="Ada"
                                            {{ (old('minum_obat_terakhir_darah') ?? $kunjunganLansia->minum_obat_terakhir_darah) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak"
                                            {{ (old('minum_obat_terakhir_darah') ?? $kunjunganLansia->minum_obat_terakhir_darah) == 'Tidak' ? 'selected' : '' }}>
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
                    <div class="card" style="margin: 2% ">
                        <div class="col-md-12">
                            <div class="form-group" style="margin-top: 1%">
                                <h5>Pemeriksaan Dalam Satu Tahun Terakhir</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_periksa_satu_tahun_gula_darah">Tanggal</label>
                                    <input type="date"
                                        class="form-control @error('tgl_periksa_satu_tahun_gula_darah') is-invalid @enderror"
                                        name="tgl_periksa_satu_tahun_gula_darah" id="tgl_periksa_satu_tahun_gula_darah"
                                        value="{{ old('tgl_periksa_satu_tahun_gula_darah') ?? $kunjunganLansia->tgl_periksa_satu_tahun_gula_darah }}">
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
                                        name="tmp_periksa_satu_tahun_gula_darah" id="tmp_periksa_satu_tahun_gula_darah">
                                        <option value="" disabled selected>Pilih Tempat</option>
                                        <option value="Puskesmas"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah') ?? $kunjunganLansia->tmp_periksa_satu_tahun_gula_darah) == 'Puskesmas' ? 'selected' : '' }}>
                                            Puskesmas</option>
                                        <option value="Polindes"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah') ?? $kunjunganLansia->tmp_periksa_satu_tahun_gula_darah) == 'Polindes' ? 'selected' : '' }}>
                                            Polindes</option>
                                        <option value="Posyandu"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah') ?? $kunjunganLansia->tmp_periksa_satu_tahun_gula_darah) == 'Posyandu' ? 'selected' : '' }}>
                                            Posyandu</option>
                                        <option value="Rumah"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah') ?? $kunjunganLansia->tmp_periksa_satu_tahun_gula_darah) == 'Rumah' ? 'selected' : '' }}>
                                            Rumah</option>
                                        <option value="Lainnya"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah') ?? $kunjunganLansia->tmp_periksa_satu_tahun_gula_darah) == 'Lainnya' ? 'selected' : '' }}>
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
                                        value="{{ old('hasil_periksa_satu_tahun_gula_darah') ?? $kunjunganLansia->hasil_periksa_satu_tahun_gula_darah }}">
                                    @error('hasil_periksa_satu_tahun_gula_darah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" style="margin-top: 1%">
                                <h5>Pemeriksaan Kencing Manis / Diabetes (DM)</h5>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tgl_kencing_manis_gula_darah">Tanggal</label>
                                <input type="date"
                                    class="form-control @error('tgl_kencing_manis_gula_darah') is-invalid @enderror"
                                    name="tgl_kencing_manis_gula_darah" id="tgl_kencing_manis_gula_darah"
                                    value="{{ old('tgl_kencing_manis_gula_darah') ?? $kunjunganLansia->tgl_kencing_manis_gula_darah }}">
                                @error('tgl_kencing_manis_gula_darah')
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
                                <h5>Pemeriksaan Kadar Gula Darah</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin: 2% ">
                        <div class="col-md-12">
                            <div class="form-group" style="margin-top: 1%">
                                <h5>Pemeriksaan Dalam Satu Tahun Terakhir</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_periksa_satu_tahun_gula_darah_melitus">Tanggal</label>
                                    <input type="date"
                                        class="form-control @error('tgl_periksa_satu_tahun_gula_darah_melitus') is-invalid @enderror"
                                        name="tgl_periksa_satu_tahun_gula_darah_melitus"
                                        id="tgl_periksa_satu_tahun_gula_darah_melitus"
                                        value="{{ old('tgl_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganLansia->tgl_periksa_satu_tahun_gula_darah_melitus }}">
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
                                        id="tmp_periksa_satu_tahun_gula_darah_melitus">
                                        <option value="" disabled selected>Pilih Tempat</option>
                                        <option value="Puskesmas"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganLansia->tmp_periksa_satu_tahun_gula_darah_melitus) == 'Puskesmas' ? 'selected' : '' }}>
                                            Puskesmas</option>
                                        <option value="Polindes"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganLansia->tmp_periksa_satu_tahun_gula_darah_melitus) == 'Polindes' ? 'selected' : '' }}>
                                            Polindes</option>
                                        <option value="Posyandu"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganLansia->tmp_periksa_satu_tahun_gula_darah_melitus) == 'Posyandu' ? 'selected' : '' }}>
                                            Posyandu</option>
                                        <option value="Rumah"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganLansia->tmp_periksa_satu_tahun_gula_darah_melitus) == 'Rumah' ? 'selected' : '' }}>
                                            Rumah</option>
                                        <option value="Lainnya"
                                            {{ (old('tmp_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganLansia->tmp_periksa_satu_tahun_gula_darah_melitus) == 'Lainnya' ? 'selected' : '' }}>
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
                                        value="{{ old('hasil_periksa_satu_tahun_gula_darah_melitus') ?? $kunjunganLansia->hasil_periksa_satu_tahun_gula_darah_melitus }}">
                                    @error('hasil_periksa_satu_tahun_gula_darah_melitus')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="obat_gula_darah_melitus">Ada Obat Diabetes Melitus</label>
                                    <select class="form-control @error('obat_gula_darah_melitus') is-invalid @enderror"
                                        name="obat_gula_darah_melitus" id="obat_gula_darah_melitus">
                                        <option value="" disabled selected>Pilih</option>
                                        <option value="Ada"
                                            {{ (old('obat_gula_darah_melitus') ?? $kunjunganLansia->obat_gula_darah_melitus) == 'Ada' ? 'selected' : '' }}>
                                            Ada</option>
                                        <option value="Tidak"
                                            {{ (old('obat_gula_darah_melitus') ?? $kunjunganLansia->obat_gula_darah_melitus) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('obat_gula_darah_melitus')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minum_obat_gula_darah_melitus">Sudah Minum Obat Hari Ini / 24 Jam
                                        Terakhir</label>
                                    <select
                                        class="form-control @error('minum_obat_gula_darah_melitus') is-invalid @enderror"
                                        name="minum_obat_gula_darah_melitus" id="minum_obat_gula_darah_melitus">
                                        <option value="" disabled selected>Pilih</option>
                                        <option value="Ya"
                                            {{ (old('minum_obat_gula_darah_melitus') ?? $kunjunganLansia->minum_obat_gula_darah_melitus) == 'Ya' ? 'selected' : '' }}>
                                            Ya</option>
                                        <option value="Tidak"
                                            {{ (old('minum_obat_gula_darah_melitus') ?? $kunjunganLansia->minum_obat_gula_darah_melitus) == 'Tidak' ? 'selected' : '' }}>
                                            Tidak</option>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Skrining / Pemeriksaan Geriatri</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin: 2% ">
                        <div class="col-md-12">
                            <div class="form-group" style="margin-top: 1%">
                                <h5>Aktifitas Kehidupan Sehari Hari (AKS)</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_aks_skrining_geriatri">Tanggal</label>
                                    <input type="date"
                                        class="form-control @error('tgl_aks_skrining_geriatri') is-invalid @enderror"
                                        name="tgl_aks_skrining_geriatri" id="tgl_aks_skrining_geriatri"
                                        autocomplete="off"
                                        value="{{ old('tgl_aks_skrining_geriatri') ?? $kunjunganLansia->tgl_aks_skrining_geriatri }}"
                                        required>
                                    @error('tgl_aks_skrining_geriatri')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tmp_aks_skrining_geriatri">Tempat</label>
                                    <select class="form-control @error('tmp_aks_skrining_geriatri') is-invalid @enderror"
                                        name="tmp_aks_skrining_geriatri" id="tmp_aks_skrining_geriatri" required>
                                        <option value="" disabled selected>Pilih Tempat</option>
                                        <option value="Puskesmas"
                                            {{ (old('tmp_aks_skrining_geriatri') ?? $kunjunganLansia->tmp_aks_skrining_geriatri) == 'Puskesmas' ? 'selected' : '' }}>
                                            Puskesmas</option>
                                        <option value="Polindes"
                                            {{ (old('tmp_aks_skrining_geriatri') ?? $kunjunganLansia->tmp_aks_skrining_geriatri) == 'Polindes' ? 'selected' : '' }}>
                                            Polindes</option>
                                        <option value="Posyandu"
                                            {{ (old('tmp_aks_skrining_geriatri') ?? $kunjunganLansia->tmp_aks_skrining_geriatri) == 'Posyandu' ? 'selected' : '' }}>
                                            Posyandu</option>
                                        <option value="Rumah"
                                            {{ (old('tmp_aks_skrining_geriatri') ?? $kunjunganLansia->tmp_aks_skrining_geriatri) == 'Rumah' ? 'selected' : '' }}>
                                            Rumah</option>
                                        <option value="Lainnya"
                                            {{ (old('tmp_aks_skrining_geriatri') ?? $kunjunganLansia->tmp_aks_skrining_geriatri) == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('tmp_aks_skrining_geriatri')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" style="margin-top: 1%">
                                <h5>Skrining Lansia Sederhana (SKILAS)</h5>
                            </div>
                        </div>
                        <div class="row" style="margin: 1%">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_skilas_skrining_geriatri">Tanggal</label>
                                    <input type="date"
                                        class="form-control @error('tgl_skilas_skrining_geriatri') is-invalid @enderror"
                                        name="tgl_skilas_skrining_geriatri" id="tgl_skilas_skrining_geriatri"
                                        autocomplete="off"
                                        value="{{ old('tgl_skilas_skrining_geriatri') ?? $kunjunganLansia->tgl_skilas_skrining_geriatri }}"
                                        required>
                                    @error('tgl_skilas_skrining_geriatri')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tmp_skilas_skrining_geriatri">Tempat</label>
                                    <select
                                        class="form-control @error('tmp_skilas_skrining_geriatri') is-invalid @enderror"
                                        name="tmp_skilas_skrining_geriatri" id="tmp_skilas_skrining_geriatri" required>
                                        <option value="" disabled selected>Pilih Tempat</option>
                                        <option value="Puskesmas"
                                            {{ (old('tmp_skilas_skrining_geriatri') ?? $kunjunganLansia->tmp_skilas_skrining_geriatri) == 'Puskesmas' ? 'selected' : '' }}>
                                            Puskesmas</option>
                                        <option value="Polindes"
                                            {{ (old('tmp_skilas_skrining_geriatri') ?? $kunjunganLansia->tmp_skilas_skrining_geriatri) == 'Polindes' ? 'selected' : '' }}>
                                            Polindes</option>
                                        <option value="Posyandu"
                                            {{ (old('tmp_skilas_skrining_geriatri') ?? $kunjunganLansia->tmp_skilas_skrining_geriatri) == 'Posyandu' ? 'selected' : '' }}>
                                            Posyandu</option>
                                        <option value="Rumah"
                                            {{ (old('tmp_skilas_skrining_geriatri') ?? $kunjunganLansia->tmp_skilas_skrining_geriatri) == 'Rumah' ? 'selected' : '' }}>
                                            Rumah</option>
                                        <option value="Lainnya"
                                            {{ (old('tmp_skilas_skrining_geriatri') ?? $kunjunganLansia->tmp_skilas_skrining_geriatri) == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('tmp_skilas_skrining_geriatri')
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
                                <label for="merokok">Merokok</label>
                                <select class="form-control @error('merokok') is-invalid @enderror" name="merokok"
                                    id="merokok">
                                    <option value="" disabled selected>Pilih Status Merokok</option>
                                    <option value="Aktif"
                                        {{ (old('merokok') ?? $kunjunganLansia->merokok) == 'Aktif' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="Pasif"
                                        {{ (old('merokok') ?? $kunjunganLansia->merokok) == 'Pasif' ? 'selected' : '' }}>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_skrining">Tanggal Skrining</label>
                                <input type="date" class="form-control @error('tgl_skrining') is-invalid @enderror"
                                    name="tgl_skrining" id="tgl_skrining"
                                    value="{{ old('tgl_skrining') ?? $kunjunganLansia->tgl_skrining }}">
                                @error('tgl_skrining')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tmp_skrining">Tempat Skrining</label>
                                <select class="form-control @error('tmp_skrining') is-invalid @enderror"
                                    name="tmp_skrining" id="tmp_skrining" required>
                                    <option value="" disabled selected>Pilih Tempat</option>
                                    <option value="Puskesmas"
                                        {{ (old('tmp_skrining') ?? $kunjunganLansia->tmp_skrining) == 'Puskesmas' ? 'selected' : '' }}>
                                        Puskesmas</option>
                                    <option value="Polindes"
                                        {{ (old('tmp_skrining') ?? $kunjunganLansia->tmp_skrining) == 'Polindes' ? 'selected' : '' }}>
                                        Polindes</option>
                                    <option value="Posyandu"
                                        {{ (old('tmp_skrining') ?? $kunjunganLansia->tmp_skrining) == 'Posyandu' ? 'selected' : '' }}>
                                        Posyandu</option>
                                    <option value="Rumah"
                                        {{ (old('tmp_skrining') ?? $kunjunganLansia->tmp_skrining) == 'Rumah' ? 'selected' : '' }}>
                                        Rumah</option>
                                    <option value="Lainnya"
                                        {{ (old('tmp_skrining') ?? $kunjunganLansia->tmp_skrining) == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
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
                                    name="petugas_skrining" id="petugas_skrining">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="Petugas Puskesmas"
                                        {{ (old('petugas_skrining') ?? $kunjunganLansia->petugas_skrining) == 'Petugas Puskesmas' ? 'selected' : '' }}>
                                        Petugas Puskesmas</option>
                                    <option value="Kader"
                                        {{ (old('petugas_skrining') ?? $kunjunganLansia->petugas_skrining) == 'Kader' ? 'selected' : '' }}>
                                        Kader</option>
                                </select>
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
                                <label for="edukasi">Edukasi</label>
                                <input type="text" class="form-control @error('edukasi') is-invalid @enderror"
                                    name="edukasi" id="edukasi"
                                    value="{{ old('edukasi') ?? $kunjunganLansia->edukasi }}">
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
            var fields = {
                'nama': document.getElementById('nama'),
                'nik': document.getElementById('nik'),
                'tgl_lahir': document.getElementById('tgl_lahir'),
                'tmp_lahir': document.getElementById('tmp_lahir'),
                'gender': document.getElementById('gender'),
                'kunjungan': document.getElementById('kunjungan'),
                'tgl_kunjungan': document.getElementById('tgl_kunjungan'),
                'suhu_tubuh': document.getElementById('suhu_tubuh'),
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
                'tgl_aks_skrining_geriatri': document.getElementById('tgl_aks_skrining_geriatri'),
                'tmp_aks_skrining_geriatri': document.getElementById('tmp_aks_skrining_geriatri'),
                'tgl_skilas_skrining_geriatri': document.getElementById('tgl_skilas_skrining_geriatri'),
                'tmp_skilas_skrining_geriatri': document.getElementById('tmp_skilas_skrining_geriatri'),
                'merokok': document.getElementById('merokok'),
                'tgl_skrining': document.getElementById('tgl_skrining'),
                'tmp_skrining': document.getElementById('tmp_skrining'),
                'petugas_skrining': document.getElementById('petugas_skrining'),
                'edukasi': document.getElementById('edukasi')
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
