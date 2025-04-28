@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit Target Desa') }}</h1>

    <!-- Main Content goes here -->
    <div class="card">
        <div class="card-body">
            <form id="target-desa-form" action="{{ route('target-desa.update', $data->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi"
                                value="{{ $data->provinsi }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota"
                                value="{{ $data->kota }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                value="{{ $data->kecamatan }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="desa">Desa</label>
                            <select class="form-control @error('desa') is-invalid @enderror" name="desa" id="desa"
                                required>
                                <option value="">Pilih Desa</option>
                                <option value="Jambewangi" {{ old('desa', $data->desa) == 'Jambewangi' ? 'selected' : '' }}>
                                    Jambewangi</option>
                                <option value="Jatitengah" {{ old('desa', $data->desa) == 'Jatitengah' ? 'selected' : '' }}>
                                    Jatitengah</option>
                                <option value="Mandesan" {{ old('desa', $data->desa) == 'Mandesan' ? 'selected' : '' }}>
                                    Mandesan</option>
                                <option value="Mrojo" {{ old('desa', $data->desa) == 'Mrojo' ? 'selected' : '' }}>Mrojo
                                </option>
                                <option value="Ploso" {{ old('desa', $data->desa) == 'Ploso' ? 'selected' : '' }}>Ploso
                                </option>
                                <option value="Popoh" {{ old('desa', $data->desa) == 'Popoh' ? 'selected' : '' }}>Popoh
                                </option>
                                <option value="Selopuro" {{ old('desa', $data->desa) == 'Selopuro' ? 'selected' : '' }}>
                                    Selopuro</option>
                                <option value="Tegalrejo" {{ old('desa', $data->desa) == 'Tegalrejo' ? 'selected' : '' }}>
                                    Tegalrejo</option>
                            </select>
                            @error('desa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="puskesmas">Puskesmas</label>
                            <input type="text" class="form-control" id="puskesmas" name="puskesmas"
                                value="{{ $data->puskesmas }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="target_penduduk">Target Penduduk</label>
                            <input type="number" class="form-control @error('target_penduduk') is-invalid @enderror"
                                name="target_penduduk" id="target_penduduk" placeholder="Target Penduduk" autocomplete="off"
                                value="{{ old('target_penduduk', $data->target_penduduk) }}" required>
                            @error('target_penduduk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" onclick="setAction('save')">Simpan</button>
                <a href="{{ route('target-desa.index') }}" class="btn btn-default">Kembali Ke List</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function setAction(action) {
            // Show SweetAlert2 loading animation
            Swal.fire({
                title: 'Saving...',
                text: 'Please wait while we save your data.',
                imageUrl: 'https://media.tenor.com/y6-Oq1X_9NcAAAAC/loading-loading-gif.gif',
                imageWidth: 100,
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });

            // Submit the form after showing the loading animation
            document.getElementById('target-desa-form').submit();
        }
    </script>
@endsection
