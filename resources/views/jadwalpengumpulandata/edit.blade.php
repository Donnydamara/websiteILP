@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Update Jadwal Pengumpulan') }}</h1>

    <!-- Main Content goes here -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('jadwal.update', ['jadwal' => $data->id]) }}" method="post" id="modal-save-form">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="puskesmas">Puskesmas</label>
                            <select class="form-control @error('puskesmas') is-invalid @enderror" name="puskesmas"
                                id="puskesmas" required>
                                <option value="">Pilih Puskesmas</option>
                                @foreach ($targetDesa as $desa)
                                    <option value="{{ $desa->puskesmas }}"
                                        {{ (old('puskesmas') ?? $data->puskesmas) == $desa->puskesmas ? 'selected' : '' }}>
                                        {{ $desa->puskesmas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('puskesmas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="posyandu">Posyandu</label>
                            <select class="form-control @error('posyandu') is-invalid @enderror" name="posyandu"
                                id="posyandu" required>
                                <option value="" disabled selected>Pilih Posyandu</option>
                                <option value="KRAJAN" {{ old('posyandu', $data->posyandu) == 'KRAJAN' ? 'selected' : '' }}>
                                    KRAJAN</option>
                                <option value="SUMBERTOK"
                                    {{ old('posyandu', $data->posyandu) == 'SUMBERTOK' ? 'selected' : '' }}>SUMBERTOK
                                </option>
                                <option value="TUMPAKPURI"
                                    {{ old('posyandu', $data->posyandu) == 'TUMPAKPURI' ? 'selected' : '' }}>TUMPAKPURI
                                </option>
                                <option value="ANGGREK"
                                    {{ old('posyandu', $data->posyandu) == 'ANGGREK' ? 'selected' : '' }}>ANGGREK</option>
                                <option value="DAHLIA"
                                    {{ old('posyandu', $data->posyandu) == 'DAHLIA' ? 'selected' : '' }}>DAHLIA</option>
                                <option value="DELIMA"
                                    {{ old('posyandu', $data->posyandu) == 'DELIMA' ? 'selected' : '' }}>DELIMA</option>
                                <option value="MAWAR" {{ old('posyandu', $data->posyandu) == 'MAWAR' ? 'selected' : '' }}>
                                    MAWAR</option>
                                <option value="MELATI"
                                    {{ old('posyandu', $data->posyandu) == 'MELATI' ? 'selected' : '' }}>MELATI</option>
                                <option value="BANYUSONGO"
                                    {{ old('posyandu', $data->posyandu) == 'BANYUSONGO' ? 'selected' : '' }}>BANYUSONGO
                                </option>
                                <option value="NGGERO"
                                    {{ old('posyandu', $data->posyandu) == 'NGGERO' ? 'selected' : '' }}>NGGERO</option>
                                <option value="GENTUNGAN"
                                    {{ old('posyandu', $data->posyandu) == 'GENTUNGAN' ? 'selected' : '' }}>GENTUNGAN
                                </option>
                                <option value="ILIK ILIK"
                                    {{ old('posyandu', $data->posyandu) == 'ILIK ILIK' ? 'selected' : '' }}>ILIK ILIK
                                </option>
                                <option value="PAKEL" {{ old('posyandu', $data->posyandu) == 'PAKEL' ? 'selected' : '' }}>
                                    PAKEL</option>
                                <option value="RINGINREJO"
                                    {{ old('posyandu', $data->posyandu) == 'RINGINREJO' ? 'selected' : '' }}>RINGINREJO
                                </option>
                                <option value="POS I" {{ old('posyandu', $data->posyandu) == 'POS I' ? 'selected' : '' }}>
                                    POS I</option>
                                <option value="POS II"
                                    {{ old('posyandu', $data->posyandu) == 'POS II' ? 'selected' : '' }}>POS II</option>
                                <option value="POS III"
                                    {{ old('posyandu', $data->posyandu) == 'POS III' ? 'selected' : '' }}>POS III</option>
                                <option value="POS IV"
                                    {{ old('posyandu', $data->posyandu) == 'POS IV' ? 'selected' : '' }}>POS IV</option>
                                <option value="POS V" {{ old('posyandu', $data->posyandu) == 'POS V' ? 'selected' : '' }}>
                                    POS V</option>
                                <option value="POS VI"
                                    {{ old('posyandu', $data->posyandu) == 'POS VI' ? 'selected' : '' }}>POS VI</option>
                            </select>
                            @error('posyandu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <select class="form-control @error('provinsi') is-invalid @enderror" name="provinsi"
                                id="provinsi" required>
                                <option value="">Pilih Provinsi</option>
                                @foreach ($targetDesa as $prov)
                                    <option value="{{ $prov->provinsi }}"
                                        {{ (old('provinsi') ?? $data->provinsi) == $prov->provinsi ? 'selected' : '' }}>
                                        {{ $prov->provinsi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kota">Kabupaten/Kota</label>
                            <select class="form-control @error('kota') is-invalid @enderror" name="kota" id="kota"
                                required>
                                <option value="">Pilih Kabupaten/Kota</option>
                                @foreach ($targetDesa as $city)
                                    <option value="{{ $city->kota }}"
                                        {{ (old('kota') ?? $data->kota) == $city->kota ? 'selected' : '' }}>
                                        {{ $city->kota }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kota')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <select class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan"
                                id="kecamatan" required>
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($targetDesa as $district)
                                    <option value="{{ $district->kecamatan }}"
                                        {{ (old('kecamatan') ?? $data->kecamatan) == $district->kecamatan ? 'selected' : '' }}>
                                        {{ $district->kecamatan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kecamatan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="desa">Desa/Kelurahan</label>
                            <select class="form-control @error('desa') is-invalid @enderror" name="desa" id="desa"
                                required>
                                <option value="">Pilih Desa/Kelurahan</option>
                                @foreach ($targetDesa as $village)
                                    <option value="{{ $village->desa }}"
                                        {{ (old('desa') ?? $data->desa) == $village->desa ? 'selected' : '' }}>
                                        {{ $village->desa }}
                                    </option>
                                @endforeach
                            </select>
                            @error('desa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dusun">Dusun</label>
                            <input type="text" class="form-control @error('dusun') is-invalid @enderror" name="dusun"
                                id="dusun" placeholder="Dusun" autocomplete="off"
                                value="{{ old('dusun') ?? $data->dusun }}" required>
                            @error('dusun')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                id="alamat" placeholder="Alamat" autocomplete="off"
                                value="{{ old('alamat') ?? $data->alamat }}" required>
                            @error('alamat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rt">RT</label>
                            <input type="text" class="form-control @error('rt') is-invalid @enderror" name="rt"
                                id="rt" placeholder="RT" autocomplete="off" value="{{ old('rt') ?? $data->rt }}"
                                required>
                            @error('rt')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rw">RW</label>
                            <input type="text" class="form-control @error('rw') is-invalid @enderror" name="rw"
                                id="rw" placeholder="RW" autocomplete="off" value="{{ old('rw') ?? $data->rw }}"
                                required>
                            @error('rw')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="postu">Postu/Posyandu Prima</label>
                            <input type="text" class="form-control @error('postu') is-invalid @enderror"
                                name="postu" id="postu" placeholder="Postu/Posyandu Prima" autocomplete="off"
                                value="{{ old('postu') ?? $data->postu }}" readonly required>
                            @error('postu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_hp">No Handphone</label>
                            <input type="number" class="form-control @error('no_hp') is-invalid @enderror"
                                name="no_hp" id="no_hp" placeholder="No Handphone" autocomplete="off"
                                value="{{ old('no_hp') ?? $data->no_hp }}" required>
                            @error('no_hp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama">Nama Kepala Keluarga</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                name="nama" id="nama" placeholder="Kepala Keluarga" autocomplete="off"
                                value="{{ old('nama') ?? $data->nama }}" required>
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kk">Kartu Keluarga</label>
                            <input type="number" class="form-control @error('kk') is-invalid @enderror" name="kk"
                                id="kk" placeholder="Kartu Keluarga" autocomplete="off"
                                value="{{ old('kk') ?? $data->kk }}" required>
                            @error('kk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" onclick="setAction('save')">Simpan</button>
                <a href="{{ route('jadwal.index') }}" class="btn btn-default">Kemabali Ke List</a>
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
                text: 'Tunggu Data Disimpan.',
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
