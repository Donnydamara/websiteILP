@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Create Data Lingkungan Rumah') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('lingkunganrumah.storevalidate') }}" method="post" id="modal-save-form">
                @csrf
                <div class="card">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kk">Kartu Keluarga</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('kk') is-invalid @enderror"
                                        name="kk" id="kk" value="{{ old('kk') }}" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="btnCekData">Cek
                                            Data</button>
                                    </div>
                                </div>
                                @error('kk')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama kepala keluarga</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" placeholder="Nama kepala keluarga" autocomplete="off"
                                    value="{{ old('nama') }}" required>
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 1%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-12">
                            <div class="form-group text-center">

                                <h5>Data Anggota Rumah Tangga</h5>
                            </div>
                        </div>
                        <div class="card" style="margin-top: 1%">
                            <div class="row" style="margin: 1%">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="AK_total">Jumlah Anggota Keluarga</label>
                                        <input type="number" class="form-control @error('AK_total') is-invalid @enderror"
                                            name="AK_total" id="AK_total" placeholder="Jumlah Anggota Keluarga"
                                            autocomplete="off" value="{{ old('AK_total') }}" required>
                                        @error('AK_total')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="AK_lansia">Jumlah Anggota Keluarga Lansia (>60 tahun)</label>
                                        <input type="number" class="form-control @error('AK_lansia') is-invalid @enderror"
                                            name="AK_lansia" id="AK_lansia"
                                            placeholder="Jumlah Anggota Keluarga Lansia (>60 tahun)" autocomplete="off"
                                            value="{{ old('AK_lansia') }}" required>
                                        @error('AK_lansia')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah_AK_dewasa">Jumlah Anggota Keluarga Usia Dewasa (>18-59
                                            Tahun)</label>
                                        <input type="number"
                                            class="form-control @error('jumlah_AK_dewasa') is-invalid @enderror"
                                            name="jumlah_AK_dewasa" id="jumlah_AK_dewasa"
                                            placeholder="Jumlah Anggota Keluarga Usia Dewasa (>18 - 59 Tahun)"
                                            autocomplete="off" value="{{ old('jumlah_AK_dewasa') }}" required>
                                        @error('jumlah_AK_dewasa')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="margin-top: 1%">
                            <div class="row" style="margin: 1%">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="AK_remaja">Jumlah Anggota Keluarga Usia Sekolah Dan Remaja (>6 - < 18
                                                Tahun)</label>
                                                <input type="number"
                                                    class="form-control @error('AK_remaja') is-invalid @enderror"
                                                    name="AK_remaja" id="AK_remaja"
                                                    placeholder="Jumlah Anggota Keluarga Usia Sekolah Dan Remaja (>6 - < 18 Tahun)"
                                                    autocomplete="off" value="{{ old('AK_remaja') }}" required>
                                                @error('AK_remaja')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="AK_balita">Jumlah Anggota Keluarga Balita (6 - 7 Bulan)</label>
                                        <input type="number" class="form-control @error('AK_balita') is-invalid @enderror"
                                            name="AK_balita" id="AK_balita"
                                            placeholder="Jumlah Anggota Keluarga Balita (6 - 7 Bulan)" autocomplete="off"
                                            value="{{ old('AK_balita') }}" required>
                                        @error('AK_balita')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="AK_bayi">Jumlah Anggota Keluarga Bayi (0-6 Bulan)</label>
                                        <input type="number" class="form-control @error('AK_bayi') is-invalid @enderror"
                                            name="AK_bayi" id="AK_bayi"
                                            placeholder="Jumlah Anggota Keluarga Bayi (0-6 Bulan)" autocomplete="off"
                                            value="{{ old('AK_bayi') }}" required>
                                        @error('AK_bayi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="margin-top: 1%">
                            <div class="row" style="margin: 1%">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="AK_ibu_bersalin_nifas">Jumlah Anggota Keluarga Ibu Bersalin
                                            Nifas</label>
                                        <input type="number"
                                            class="form-control @error('AK_ibu_bersalin_nifas') is-invalid @enderror"
                                            name="AK_ibu_bersalin_nifas" id="AK_ibu_bersalin_nifas"
                                            placeholder="Jumlah Anggota Keluarga Ibu Bersalin Nifas" autocomplete="off"
                                            value="{{ old('AK_ibu_bersalin_nifas') }}" required>
                                        @error('AK_ibu_bersalin_nifas')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="AK_ibu_hamil">Jumlah Anggota Keluarga Ibu Hamil</label>
                                        <input type="number"
                                            class="form-control @error('AK_ibu_hamil') is-invalid @enderror"
                                            name="AK_ibu_hamil" id="AK_ibu_hamil"
                                            placeholder="Jumlah Anggota Keluarga Ibu Hamil" autocomplete="off"
                                            value="{{ old('AK_ibu_hamil') }}" required>
                                        @error('AK_ibu_hamil')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 1%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jkn_jamkesda">Apakah memiliki Jaminan Kesehatan Nasional (JKN)/ Jaminan
                                    Kesehatan
                                    (Jamkesda)/ Asuransi Kesehatan</label>
                                <select class="form-control @error('jkn_jamkesda') is-invalid @enderror"
                                    name="jkn_jamkesda" id="jkn_jamkesda" required>
                                    <option value="">Pilih</option>
                                    <option value="Ya" {{ old('jkn_jamkesda') == 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak" {{ old('jkn_jamkesda') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('jkn_jamkesda')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sarana_air">Apakah tersedia sarana air bersih di lingkungan rumah</label>
                                <select class="form-control @error('sarana_air') is-invalid @enderror" name="sarana_air"
                                    id="sarana_air" required>
                                    <option value="">Pilih</option>
                                    <option value="Ya" {{ old('sarana_air') == 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak" {{ old('sarana_air') == 'Tidak' ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>
                                @error('sarana_air')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jenis_sumber_air">Bila YA apa jenis sumber airnya terlindungi</label>
                                <select class="form-control @error('jenis_sumber_air') is-invalid @enderror"
                                    name="jenis_sumber_air" id="jenis_sumber_air">
                                    <option value="">Pilih</option>
                                    <option value="Ya(PDAM, Sumur, Pompa, Sumur Gali Terlindung, Mata Air Terlindung) "
                                        {{ old('jenis_sumber_air') == 'Ya(PDAM, Sumur, Pompa, Sumur Gali Terlindung, Mata Air Terlindung) ' ? 'selected' : '' }}>
                                        Ya(PDAM, Sumur, Pompa, Sumur Gali Terlindung, Mata Air Terlindung) </option>
                                    <option value="Tidak (Sumur Terbuka, Air Sungai, Danau / Telaga Dll)"
                                        {{ old('jenis_sumber_air') == 'Tidak (Sumur Terbuka, Air Sungai, Danau / Telaga Dll)' ? 'selected' : '' }}>
                                        Tidak (Sumur Terbuka, Air Sungai, Danau / Telaga Dll)</option>
                                </select>
                                @error('jenis_sumber_air')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 1%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jamban">Apakah tersedia jamban</label>
                                <select class="form-control @error('jamban') is-invalid @enderror" name="jamban"
                                    id="jamban" required>
                                    <option value="">Pilih</option>
                                    <option value="Ya" {{ old('jamban') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('jamban') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                                @error('jamban')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jenis_jamban">Bila YA apakah jenis jambannya saniter</label>
                                <select class="form-control @error('jenis_jamban') is-invalid @enderror"
                                    name="jenis_jamban" id="jenis_jamban" required>
                                    <option value="">Pilih</option>
                                    <option value="Ya (Kloset / Leher Angsa / Plengsengan)"
                                        {{ old('jenis_jamban') == 'Ya (Kloset / Leher Angsa / Plengsengan)' ? 'selected' : '' }}>
                                        Ya (Kloset / Leher Angsa / Plengsengan)
                                    </option>
                                    <option value="Tidak (Cemplung)"
                                        {{ old('jenis_jamban') == 'Tidak (Cemplung)' ? 'selected' : '' }}>Tidak (Cemplung)
                                    </option>
                                </select>
                                @error('jenis_jamban')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ventilasi">Apakah Rumah Memiliki Ventilasi</label>
                                <select class="form-control @error('ventilasi') is-invalid @enderror" name="ventilasi"
                                    id="ventilasi" required>
                                    <option value="">Pilih</option>
                                    <option value="Ya" {{ old('ventilasi') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ old('ventilasi') == 'Tidak' ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>
                                @error('ventilasi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 1%">
                    <div class="row" style="margin: 1%">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mengalami_gangguan_jiwa">Apakah ada anggota keluarga yang mengalami gangguan
                                    jiwa</label>
                                <select class="form-control @error('mengalami_gangguan_jiwa') is-invalid @enderror"
                                    name="mengalami_gangguan_jiwa" id="mengalami_gangguan_jiwa" required>
                                    <option value="">Pilih</option>
                                    <option value="Ya" {{ old('mengalami_gangguan_jiwa') == 'Ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="Tidak"
                                        {{ old('mengalami_gangguan_jiwa') == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>
                                @error('mengalami_gangguan_jiwa')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="TBC_hipertensi_millitus">Apakah ada anggota keluarga yang terdiaknosa (TBC,
                                    Hipertensi dan
                                    Diabetes Mellitus)</label>
                                <select class="form-control @error('TBC_hipertensi_millitus') is-invalid @enderror"
                                    name="TBC_hipertensi_millitus" id="TBC_hipertensi_millitus" required>
                                    <option value="">Pilih</option>
                                    <option value="TBC"
                                        {{ old('TBC_hipertensi_millitus') == 'TBC' ? 'selected' : '' }}>TBC
                                    </option>
                                    <option value="Hipertensi"
                                        {{ old('TBC_hipertensi_millitus') == 'Hipertensi' ? 'selected' : '' }}>
                                        Hipertensi</option>
                                    <option value="Diabetes Melitus"
                                        {{ old('TBC_hipertensi_millitus') == 'Diabetes Melitus' ? 'selected' : '' }}>
                                        Diabetes Melitus
                                    </option>
                                </select>
                                @error('TBC_hipertensi_millitus')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="setAction('save')">Simpan</button>
                    <a href="{{ route('lingkunganrumah.index') }}" class="btn btn-default">Kembali Ke List</a>
                </div>
                <!-- continue with the rest of the fields -->


            </form>
        </div>
    </div>

    <!-- End of Main Content -->
@endsection

@section('scripts')
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('btnCekData').addEventListener('click', function() {
            var kk = document.getElementById('kk').value;

            Swal.fire({
                title: 'Checking...',
                text: 'Please wait while we check the data.',
                imageUrl: 'https://media.tenor.com/y6-Oq1X_9NcAAAAC/loading-loading-gif.gif',
                imageWidth: 100,
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });

            fetch('{{ route('lingkunganrumah.checkKK') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        kk: kk
                    })
                })
                .then(response => response.json())
                .then(data => {
                    Swal.close(); // Menutup loading SweetAlert2
                    document.getElementById('nama').value = data.data.nama;
                    Swal.fire({
                        icon: 'success',
                        title: 'KK Ditemukan',
                        text: 'Nama: ' + data.data.nama
                    });
                })
                .catch(error => {
                    Swal.close(); // Menutup loading SweetAlert2
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error checking the KK.'
                    });
                    console.error('Error:', error);
                });
        });

        document.getElementById('modal-save-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah submit default

            Swal.fire({
                title: 'Simpan...',
                text: 'Tunggu Data Sedang Di Simpan.',
                imageUrl: 'https://media.tenor.com/y6-Oq1X_9NcAAAAC/loading-loading-gif.gif',
                imageWidth: 100,
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });

            // Submit form setelah menampilkan animasi loading
            this.submit();
        });

        function setAction(action) {
            // Show SweetAlert2 loading animation
            Swal.fire({
                title: 'Simpan...',
                text: 'Tunggu Data Sedang Di Simpan.',
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
