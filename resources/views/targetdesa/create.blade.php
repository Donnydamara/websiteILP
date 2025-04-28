@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Tambah Target Desa ') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('target-desa.store') }}" method="post" id="modal-save-form">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi" value="Jawa Timur"
                                readonly required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" value="Kab. Blitar"
                                readonly required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="Kec. Selopuro"
                                readonly required>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="desa">Desa</label>
                            <input type="text" class="form-control @error('desa') is-invalid @enderror" name="desa"
                                id="desa" placeholder="Desa" autocomplete="off" value="{{ old('desa') }}" required>
                            @error('desa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="desa">Desa</label>
                            <select class="form-control @error('desa') is-invalid @enderror" name="desa" id="desa"
                                required>
                                <option value="" disabled selected>Pilih Desa</option>
                                <option value="Jambewangi">Jambewangi</option>
                                <option value="Jatitengah">Jatitengah</option>
                                <option value="Mandesan">Mandesan</option>
                                <option value="Mrojo">Mrojo</option>
                                <option value="Ploso">Ploso</option>
                                <option value="Popoh">Popoh</option>
                                <option value="Selopuro">Selopuro</option>
                                <option value="Tegalrejo">Tegalrejo</option>

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
                                value="UPT Puskesmas Selopuro" readonly required>
                        </div>

                        {{-- <div class="form-group">
                            <label for="puskesmas">Puskesmas</label>
                            <input type="text" class="form-control @error('puskesmas') is-invalid @enderror"
                                name="puskesmas" id="puskesmas" placeholder="Puskesmas" autocomplete="off"
                                value="{{ old('puskesmas') }}" required>
                            @error('puskesmas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="target_penduduk">Target Penduduk</label>
                            <input type="number" class="form-control @error('target_penduduk') is-invalid @enderror"
                                name="target_penduduk" id="target_penduduk" placeholder="Target Penduduk" autocomplete="off"
                                value="{{ old('target_penduduk') }}" required>
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
