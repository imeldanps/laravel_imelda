<form action="{{ url('/barang/import_ajax') }}" method="POST" id="form-import" enctype="multipart/form-data">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Download Template</label>
                    <a href="{{ asset('template_barang.xlsx') }}" class="btn btn-info btn-sm" download>
                        <i class="fa fa-file-excel"></i> Download
                    </a>
                </div>
                <div class="form-group">
                    <label>Pilih File</label>
                    <input type="file" name="file_barang" id="file_barang" class="form-control" required>
                    <small id="error-file_barang" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-import").on('submit', function(e) {
            e.preventDefault();

            var fileInput = $('#file_barang')[0];
            if (fileInput.files.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'File Kosong',
                    text: 'Silakan pilih file Excel (.xlsx) terlebih dahulu!'
                });
                return false;
            }

            var fileName = fileInput.files[0].name;
            var ext = fileName.split('.').pop().toLowerCase();
            if (ext !== 'xlsx') {
                Swal.fire({
                    icon: 'error',
                    title: 'Format Salah',
                    text: 'File yang dipilih adalah .' + ext + '. Harap pilih file Excel Workbook (.xlsx)!'
                });
                return false;
            }

            var formData = new FormData(this);
            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    form.find('button[type="submit"]').attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Uploading...');
                },
                success: function(response) {
                    if (response.status) {
                        $('#myModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        });
                        if (typeof dataBarang !== 'undefined') {
                            dataBarang.ajax.reload();
                        }
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
                        text: 'Gagal mengupload data. Cek format file Excel Anda.'
                    });
                },
                complete: function() {
                    form.find('button[type="submit"]').attr('disabled', false).html('Upload');
                }
            });
        });
    });
</script>