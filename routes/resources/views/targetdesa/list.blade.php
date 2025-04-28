@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Target Desa List') }}</h1>

    <!-- Main Content goes here -->
    <a href="{{ route('target-desa.create') }}" class="btn btn-primary mb-3">Tambah</a>

    <!-- Display success message if any -->
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

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Provinsi</th>
                    <th>Kota</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Puskesmas</th>
                    <th>Target Kepala Keluarga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($targetDesas as $targetDesa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $targetDesa->provinsi }}</td>
                        <td>{{ $targetDesa->kota }}</td>
                        <td>{{ $targetDesa->kecamatan }}</td>
                        <td>{{ $targetDesa->desa }}</td>
                        <td>{{ $targetDesa->puskesmas }}</td>
                        <td>{{ $targetDesa->target_penduduk }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('target-desa.edit', $targetDesa->id) }}"
                                    class="btn btn-sm btn-primary mr-2">Edit</a>


                                <form action="{{ route('target-desa.destroy', $targetDesa->id) }}" method="post"
                                    class="delete-form">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger delete-button">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $targetDesas->links() }}
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formElement = this;
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formElement.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
