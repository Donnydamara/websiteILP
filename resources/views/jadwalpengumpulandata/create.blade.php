@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Tambah Jadwal Pengumpulan') }}</h1>

    <!-- Main Content goes here -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                });
            });
        </script>
    @endif
    <div class="card">
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100">10%</div>
        </div>
        <div class="card-body">

            {{-- <form id="target-desa-form" action="{{ route('jadwal.store') }}" method="post"> <!-- Perubahan pada action --> --}}
            <form id="target-desa-form" action="{{ route('jadwal.storejad') }}" method="post">
                <!-- Perubahan pada action -->
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="puskesmas">Puskesmas</label>
                            <select class="form-control @error('puskesmas') is-invalid @enderror" name="puskesmas"
                                id="puskesmas" required>
                                <option value="">Pilih Puskesmas</option>
                                @foreach ($puskesmasList as $puskesmas)
                                    <option value="{{ $puskesmas }}">{{ $puskesmas }}</option>
                                @endforeach
                            </select>
                            @error('puskesmas')
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
                            </select>
                            @error('desa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="dusun">Dusun</label>
                            <select class="form-control @error('dusun') is-invalid @enderror" name="dusun" id="dusun"
                                required>
                                <option value="">Pilih Dusun</option>
                                <option value="Dusun Krajan" {{ old('dusun') == 'Dusun Krajan' ? 'selected' : '' }}>Dusun
                                    Krajan</option>
                                <option value="Dusun Jatiluhur" {{ old('dusun') == 'Dusun Jatiluhur' ? 'selected' : '' }}>
                                    Dusun Jatiluhur</option>
                                <option value="Dusun Jatirejo" {{ old('dusun') == 'Dusun Jatirejo' ? 'selected' : '' }}>
                                    Dusun Jatirejo</option>
                                <option value="Dusun Jogosimo" {{ old('dusun') == 'Dusun Jogosimo' ? 'selected' : '' }}>
                                    Dusun Jogosimo</option>
                            </select>
                            @error('dusun')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div> --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dusun">Dusun</label>
                            <input type="text" class="form-control @error('dusun') is-invalid @enderror" name="dusun"
                                id="dusun" placeholder="dusun" autocomplete="off" value="{{ old('dusun') }}" required>
                            @error('dusun')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                id="alamat" placeholder="Alamat" autocomplete="off" value="{{ old('alamat') }}"
                                required>
                            @error('alamat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rt">RT</label>
                            <input type="text" class="form-control @error('rt') is-invalid @enderror" name="rt"
                                id="rt" placeholder="RT" autocomplete="off" value="{{ old('rt') }}" required>
                            @error('rt')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rw">RW</label>
                            <input type="text" class="form-control @error('rw') is-invalid @enderror" name="rw"
                                id="rw" placeholder="RW" autocomplete="off" value="{{ old('rw') }}" required>
                            @error('rw')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="postu">Postu/Posyandu Prima</label>
                            <input type="text" class="form-control" id="postu" name="postu"
                                value="Popoh Selopuro" readonly required>
                        </div>
                    </div>
                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="postu">Postu/Posyandu Prima</label>
                            <input type="text" class="form-control @error('postu') is-invalid @enderror"
                                name="postu" id="postu" placeholder="Postu/Posyandu Prima" autocomplete="off"
                                value="{{ old('postu') }}" required>
                            @error('postu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="posyandu">Posyandu</label>
                            <select class="form-control @error('posyandu') is-invalid @enderror" name="posyandu"
                                id="posyandu" required>
                                <option value="" disabled selected>Pilih Posyandu</option>
                                <option value="KRAJAN" {{ old('posyandu') == 'KRAJAN' ? 'selected' : '' }}>KRAJAN</option>
                                <option value="SUMBERTOK" {{ old('posyandu') == 'SUMBERTOK' ? 'selected' : '' }}>SUMBERTOK
                                </option>
                                <option value="TUMPAKPURI" {{ old('posyandu') == 'TUMPAKPURI' ? 'selected' : '' }}>
                                    TUMPAKPURI</option>
                                <option value="ANGGREK" {{ old('posyandu') == 'ANGGREK' ? 'selected' : '' }}>ANGGREK
                                </option>
                                <option value="DAHLIA" {{ old('posyandu') == 'DAHLIA' ? 'selected' : '' }}>DAHLIA</option>
                                <option value="DELIMA" {{ old('posyandu') == 'DELIMA' ? 'selected' : '' }}>DELIMA</option>
                                <option value="MAWAR" {{ old('posyandu') == 'MAWAR' ? 'selected' : '' }}>MAWAR</option>
                                <option value="MELATI" {{ old('posyandu') == 'MELATI' ? 'selected' : '' }}>MELATI</option>
                                <option value="BANYUSONGO" {{ old('posyandu') == 'BANYUSONGO' ? 'selected' : '' }}>
                                    BANYUSONGO</option>
                                <option value="NGGERO" {{ old('posyandu') == 'NGGERO' ? 'selected' : '' }}>NGGERO</option>
                                <option value="GENTUNGAN" {{ old('posyandu') == 'GENTUNGAN' ? 'selected' : '' }}>GENTUNGAN
                                </option>
                                <option value="ILIK ILIK" {{ old('posyandu') == 'ILIK ILIK' ? 'selected' : '' }}>ILIK ILIK
                                </option>
                                <option value="PAKEL" {{ old('posyandu') == 'PAKEL' ? 'selected' : '' }}>PAKEL</option>
                                <option value="RINGINREJO" {{ old('posyandu') == 'RINGINREJO' ? 'selected' : '' }}>
                                    RINGINREJO</option>
                                <option value="POS I" {{ old('posyandu') == 'POS I' ? 'selected' : '' }}>POS I</option>
                                <option value="POS II" {{ old('posyandu') == 'POS II' ? 'selected' : '' }}>POS II</option>
                                <option value="POS III" {{ old('posyandu') == 'POS III' ? 'selected' : '' }}>POS III
                                </option>
                                <option value="POS IV" {{ old('posyandu') == 'POS IV' ? 'selected' : '' }}>POS IV</option>
                                <option value="POS V" {{ old('posyandu') == 'POS V' ? 'selected' : '' }}>POS V</option>
                                <option value="POS VI" {{ old('posyandu') == 'POS VI' ? 'selected' : '' }}>POS VI</option>
                            </select>
                            @error('posyandu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_hp">No Handphome</label>
                            <input type="number" class="form-control @error('no_hp') is-invalid @enderror"
                                name="no_hp" id="no_hp" placeholder="No Handphome" autocomplete="off"
                                value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama">Nama Kepala Keluarga</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                name="nama" id="nama" placeholder="Nama Kepala Keluarga" autocomplete="off"
                                value="{{ old('nama') }}" required>
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
                                value="{{ old('kk') }}" required>
                            @error('kk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" onclick="setAction('save')">Simpan</button>
                <a href="{{ route('jadwal.index') }}" class="btn btn-default">Kembali Ke List</a>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('puskesmas').addEventListener('change', function() {
            var puskesmas = this.value;
            fetch(`/getDesaByPuskesmas?puskesmas=${puskesmas}`)
                .then(response => response.json())
                .then(data => {
                    // Clear previous options
                    ['provinsi', 'kota', 'kecamatan', 'desa'].forEach(id => {
                        document.getElementById(id).innerHTML = '<option value="">Pilih</option>';
                    });

                    data.forEach(item => {
                        document.getElementById('provinsi').innerHTML +=
                            `<option value="${item.provinsi}">${item.provinsi}</option>`;
                        document.getElementById('kota').innerHTML +=
                            `<option value="${item.kota}">${item.kota}</option>`;
                        document.getElementById('kecamatan').innerHTML +=
                            `<option value="${item.kecamatan}">${item.kecamatan}</option>`;
                        document.getElementById('desa').innerHTML +=
                            `<option value="${item.desa}">${item.desa}</option>`;
                    });
                });
        });
    </script>
@endsection
