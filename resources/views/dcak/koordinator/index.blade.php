<x-app-layout :assets="$assets ?? []">

    <style>
        #showModalKoordinator .modal-content {
            color: black;
        }

    </style>


    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Koordinator</h4>
                            </div>
                            <div class="col-md-6 text-md-end">

                                <a href="{{ route('input-koordinator') }}" class="d-inline-block">
                                    <button type="button" class="btn btn-success">Tambah Data</button>
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        Data ini menampilakn koordinator yang telah terdaftar.
                    </p>
                    <div class="table-responsive">

                        <table id="datatableKoordinator" class="table table-striped dt-responsive nowrap" data-toggle="data-table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Koordinator</th>
                                    <th>Jumlah Surat Dukungan</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showModalKoordinator" tabindex="-1" aria-labelledby="ModalKoordinator" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalKoordinator">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables
            if ($.fn.dataTable.isDataTable('#datatableKoordinator')) {
                $('#datatableKoordinator').DataTable().destroy();
            }

            $('#datatableKoordinator').DataTable({
                processing: true
                , destroy: true
                , responsive: true
                , serverSide: true
                , ajax: '{{ route("table-koordinator") }}'
                , columns: [{
                        data: 'id_koordinator'
                        , name: 'id_koordinator'
                    }
                    , {
                        data: 'nama_koordinator'
                        , name: 'nama_koordinator'
                    }
                    , {
                        data: 'jumlah_surat_dukungan'
                        , name: 'jumlah_surat_dukungan'
                    }
                    , {
                        data: 'kelurahan'
                        , name: 'kelurahan'
                    }
                    , {
                        data: 'kecamatan'
                        , name: 'kecamatan'
                    }
                    , {
                        data: 'id_koordinator'
                        , name: 'id_koordinator'
                        , render: function(data, type, row) {
                            return `
                            <button onclick="editKoordinator(${data})" class="btn btn-warning btn-sm">Edit</button>
                            <button onclick="hapusKoordinator(${data})" class="btn btn-danger btn-sm">Hapus</button>
                        `;
                        }
                    }
                ]
                , order: [0, 'desc']
            });
        });

        function editKoordinator(id) {
            $.get(`/edit-koordinator/${id}`)
                .done(function(data) {
                    $('#ModalKoordinator').text('Edit Koordinator');
                    $('#showModalKoordinator .modal-body').html(`
                    <form id="updateKoordinatorForm" action="/form-edit-koordinator/${id}" method="post">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="id" value="${id}">

                        <div class="mb-3">
                            <label>Nama Koordinator</label>
                            <input type="text" name="nama_koordinator" class="form-control" value="${data.nama_koordinator}">
                        </div>

                        <div class="mb-3">
                            <label>Kelurahan</label>
                            <input type="text" name="kelurahan" class="form-control" value="${data.kelurahan}">
                        </div>

                        <div class="mb-3">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" value="${data.kecamatan}">
                        </div>

                        <div class="mb-3">
                            <label>Jumlah Surat Dukungan</label>
                            <input type="number" name="jumlah_surat_dukungan" class="form-control" value="${data.jumlah_surat_dukungan}">
                        </div>

                        <div class="form-group float-end">
                        <button type="button" id="modalSimpanKoordinator" class="btn btn-primary">Simpan</button>
                        </div>

                    </form>
                `);
                    $('#showModalKoordinator').modal('show');

                    $('#modalSimpanKoordinator').off('click').click(function() {
                        $('#updateKoordinatorForm').submit();
                    });
                })
                .fail(function() {
                    alert('Failed to fetch data. Please try again.');
                });
        }

        function hapusKoordinator(id) {
            if (confirm("Apakah Anda yakin ingin menghapus koordinator ini?")) {
                $.ajax({
                    url: `/delete-koordinator/${id}`
                    , method: 'DELETE'
                    , data: {
                        _token: '{{ csrf_token() }}'
                    }
                    , success: function(response) {
                        if (response.success) {
                            alert('Data koordinator berhasil dihapus.');
                            $('#datatableKoordinator').DataTable().ajax.reload(); // Reload tabel
                        } else {
                            alert('Gagal menghapus data.');
                        }
                    }
                    , error: function() {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            }
        }

    </script>





</x-app-layout>
