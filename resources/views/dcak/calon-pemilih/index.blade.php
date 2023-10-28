<x-app-layout :assets="$assets ?? []">

    <style>
        #showModalCalonPemilih .modal-content {
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
                                <h4 class="card-title">Calon Pemilih</h4>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <form action="{{ route('import-calon-pemilih') }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
                                    @csrf
                                    <input type="file" name="excel_file" id="excel_file" required onchange="this.form.submit();" style="display:none;">
                                    <button type="button" class="btn btn-primary" id="activateInput">Import Data Excel</button>
                                </form>

                                <a href="{{ route('input-calon-pemilih') }}" class="d-inline-block">
                                    <button type="button" class="btn btn-success">Tambah Data</button>
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        Data ini menampilakn calon pemilih yang telah terdaftar.
                    </p>
                    <div class="table-responsive">
                        <table id="datatableCalonPemilih" class="table table-striped dt-responsive nowrap" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Pemilih</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No HP</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>TPS</th>
                                    <th>Kelurahan</th>
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

    <!-- Edit Calon Pemilih Modal -->
    <div class="modal fade" id="showModalCalonPemilih" tabindex="-1" aria-labelledby="ModalCalonPemilih" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalCalonPemilih">Modal title</h5>
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

            document.getElementById("activateInput").addEventListener("click", function() {
                document.getElementById("excel_file").click();
            });


            if ($.fn.dataTable.isDataTable('#datatableCalonPemilih')) {
                $('#datatableCalonPemilih').DataTable().destroy();
            }

            $('#datatableCalonPemilih').DataTable({
                processing: true
                , destroy: true
                , responsive: true
                , serverSide: true
                , ajax: '{{ route("table-calon-pemilih") }}'
                , columns: [


                    {
                        data: null
                        , sortable: false
                        , searchable: false
                        , render: function(data, type, row, meta) {
                            // Mengurutkan dari nomor terakhir
                            let recordsTotal = meta.settings.fnRecordsTotal();
                            return recordsTotal - meta.row;
                        }
                    },

                    {
                        data: 'nik'
                        , name: 'nik'
                    }
                    , {
                        data: 'nama_pemilih'
                        , name: 'nama_pemilih'
                    }
                    , {
                        data: 'jenis_kelamin'
                        , name: 'jenis_kelamin'
                    }
                    , {
                        data: 'no_hp'
                        , name: 'no_hp'
                    }
                    , {
                        data: 'rt'
                        , name: 'rt'
                    }
                    , {
                        data: 'rw'
                        , name: 'rw'
                    }
                    , {
                        data: 'tps'
                        , name: 'tps'
                    }
                    , {
                        data: 'kelurahan'
                        , name: 'kelurahan'
                    }

                    , {
                        data: 'id_calon_pemilih'
                        , name: 'id_calon_pemilih'
                        , render: function(data, type, row) {
                            return `
                            <button onclick="editCalonPemilih(${data})" class="btn btn-warning btn-sm">Edit</button>
                            <button onclick="hapusCalonPemilih(${data})" class="btn btn-danger btn-sm">Hapus</button>
                        `;
                        }
                    }

                , ]
                , order: [0, 'desc']


            });
        });

        // Edit Calon Pemilih
        function editCalonPemilih(id) {
            $.get(`/edit-calon-pemilih/${id}`)
                .done(function(data) {
                    $('#ModalCalonPemilih').text('Edit Calon Pemilih');
                    $('#showModalCalonPemilih .modal-body').html(`
            <form id="updateCalonPemilihForm" action="/form-edit-calon-pemilih/${id}" method="post">
                @method('POST')
                @csrf
                <input type="hidden" name="id" value="${id}">

                <div class="mb-3">
                    <label>NIK</label>
                    <input type="number" name="nik" class="form-control" value="${data.nik}">
                </div>

                <div class="mb-3">
                    <label>Nama Pemilih</label>
                    <input type="text" name="nama_pemilih" class="form-control" value="${data.nama_pemilih}">
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select class="form-select" aria-label="Default select example" name="jenis_kelamin" id="jenis_kelamin" required>
                        <option selected>Pilih Jenis Kelamin</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="number" name="no_hp" class="form-control" value="${data.no_hp}">
                </div>

                <div class="mb-3">
                    <label>RT</label>
                    <input type="number" name="rt" class="form-control" value="${data.rt}">
                </div>

                <div class="mb-3">
                    <label>RW</label>
                    <input type="number" name="rw" class="form-control" value="${data.rw}">
                </div>

                <div class="mb-3">
                    <label>TPS</label>
                    <input type="number" name="tps" class="form-control" value="${data.tps}">
                </div>

                <div class="mb-3">
                    <label>Kelurahan</label>
                    <input type="text" name="kelurahan" class="form-control" value="${data.kelurahan}">
                </div>

                <div class="form-group float-end">
                    <button type="button" id="modalSimpanCalonPemilih" class="btn btn-primary">Simpan</button>
                </div>

            </form>
            `);

                    if (data.jenis_kelamin === 'Pria') {
                        $('#jenis_kelamin').val('Pria');
                    } else if (data.jenis_kelamin === 'Wanita') {
                        $('#jenis_kelamin').val('Wanita');
                    }



                    $('#showModalCalonPemilih').modal('show');

                    $('#modalSimpanCalonPemilih').off('click').click(function() {
                        $('#updateCalonPemilihForm').submit();
                    });
                })
                .fail(function() {
                    alert('Failed to fetch data. Please try again.');
                });
        }

        // Hapus Calon Pemilih
        function hapusCalonPemilih(id) {
            if (confirm("Apakah Anda yakin ingin menghapus calon pemilih ini?")) {
                $.ajax({
                    url: `/delete-calon-pemilih/${id}`
                    , method: 'DELETE'
                    , data: {
                        _token: '{{ csrf_token() }}'
                    }
                    , success: function(response) {
                        if (response.success) {
                            alert('Data calon pemilih berhasil dihapus.');
                            $('#datatableCalonPemilih').DataTable().ajax.reload(); // Reload tabel
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
