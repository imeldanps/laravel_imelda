@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah</a>
                <button onclick="modalAction('{{ url('/user/create_ajax') }}')"
                    class="btn btn-sm btn-success mt-1">TambahAjax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level Pengguna</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
            <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
                data-keyboard="false" data-width="75%" aria-hidden="true"></div>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }

        var dataUser;

        $(document).ready(function () {
            dataUser = $('#table_user').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    "url": "{{ url('user/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                    { data: "username", className: "", orderable: true, searchable: true },
                    { data: "nama", className: "", orderable: true, searchable: true },
                    { data: "level.level_nama", className: "", orderable: false, searchable: false },
                    { data: "aksi", className: "", orderable: false, searchable: false }
                ]
            });

            // --- PERUBAHAN UTAMA DISINI (EVENT DELEGATION) ---
            // Script ini menempel pada #myModal dan memantau submit form di dalamnya
            $('#myModal').on('submit', '#form-edit, #form-delete', function(e) {
                e.preventDefault(); // Kunci: Mencegah Redirect
                
                var form = $(this); // Form yang sedang disubmit (bisa edit atau delete)
                
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'), // POST atau DELETE sesuai HTML
                    data: form.serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            // Reload tabel
                            dataUser.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal menghubungi server.'
                        });
                    }
                });
            });
        });
    </script>
@endpush