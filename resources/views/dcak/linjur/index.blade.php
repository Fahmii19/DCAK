<x-app-layout :assets="$assets ?? []">

    <style>
        #showModalPemilih .modal-content {
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
                                <h4 class="card-title">Daftar Pemilih Tetap</h4>
                            </div>
                            <div class="col-md-6 d-flex justify-content-md-end align-items-center custom-mt">

                                <form action="{{ route('import-pemilih') }}" method="POST" enctype="multipart/form-data"
                                    class="d-inline-block me-3">
                                    {{-- @csrf
                                    <input type="file" name="excel_file_pemilih" id="excel_file_pemilih" required onchange="this.form.submit();" style="display:none;">
                                    <button type="button" class="btn btn-primary" id="activateInputPemilih">Import Data Excel</button> --}}
                                </form>

                                <a href="{{ route('input-linjur') }}" class="d-inline-block">
                                    <button type="button" class="btn btn-success">Tambah Data Linjur</button>
                                </a>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        Data ini menampilkan pemilih yang telah terdaftar.
                    </p>
                    <div class="table-responsive">
                        <table id="datatablePemilih" class="table table-striped dt-responsive nowrap"
                            data-toggle="data-table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Koordinator</th>
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


    <div class="modal fade" id="showModalPemilih" tabindex="-1" aria-labelledby="ModalPemilih" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalPemilih">Modal title</h5>
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


            // document.getElementById("activateInputPemilih").addEventListener("click", function() {
            //     document.getElementById("excel_file_pemilih").click();
            // });

            if ($.fn.dataTable.isDataTable('#datatablePemilih')) {
                $('#datatablePemilih').DataTable().destroy();
            }

            $('#datatablePemilih').DataTable({
                processing: true,
                destroy: true,
                responsive: true,
                serverSide: true,
                ajax: '{{ route('table-pemilih') }}',
                columns: [

                    {
                        data: 'id_pemilih',
                        name: 'id_pemilih',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    }

                    , {
                        data: 'nama_koordinator',
                        name: 'nama_koordinator'
                    }, {
                        data: 'nik',
                        name: 'nik'
                    }, {
                        data: 'nama_pemilih',
                        name: 'nama_pemilih'
                    }, {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    }, {
                        data: 'no_hp',
                        name: 'no_hp'
                    }, {
                        data: 'rt',
                        name: 'rt'
                    }, {
                        data: 'rw',
                        name: 'rw'
                    }, {
                        data: 'tps',
                        name: 'tps'
                    }, {
                        data: 'kelurahan',
                        name: 'kelurahan'
                    }

                    , {
                        data: 'id_pemilih',
                        name: 'id_pemilih',
                        render: function(data, type, row) {
                            return `
                                <button onclick="editPemilih(${data})" class="btn btn-warning btn-sm">Edit</button>
                                <button onclick="hapusPemilih(${data}, ${row.id_calon_pemilih})" class="btn btn-danger btn-sm">Hapus</button>
                            `;
                        }
                    }

                    ,
                ],
                order: [0, 'desc']


            });
        });

        function editPemilih(id) {
            $.get(`/edit-pemilih/${id}`).done(function(data) {
                $('#ModalPemilih').text('Edit Pemilih');
                $('#showModalPemilih .modal-body').html(`

                    <form id="updatePemilihForm" action="/form-edit-pemilih/${id}" method="post">

                        @method('POST')
                        @csrf

                        <div class="mb-3">
                            <label>Nama Koordinator</label>
                            <input type="text" name="nama_koordinator" class="form-control" value="${data.nama_koordinator}">
                        </div>

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
                        <button type="button" class="btn btn-primary" id="modalSimpanPemilih">Simpan</button>
                        </div>


                    `);

                if (data.jenis_kelamin === 'Pria') {
                    $('#jenis_kelamin').val('Pria');
                } else if (data.jenis_kelamin === 'Wanita') {
                    $('#jenis_kelamin').val('Wanita');
                }


                $('#showModalPemilih').modal('show');

                $('#modalSimpanPemilih').off('click').click(function() {
                    $('#updatePemilihForm').submit();
                });
            })

        }

        function hapusPemilih(idPemilih, idCalonPemilih) {
            if (confirm("Apakah Anda yakin ingin menghapus pemilih ini?")) {
                $.ajax({
                    url: `/delete-pemilih/${idPemilih}/${idCalonPemilih}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Data pemilih berhasil dihapus.');
                            $('#datatablePemilih').DataTable().ajax.reload();
                        } else {
                            alert('Gagal menghapus data.');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            }
        }
    </script>




</x-app-layout>
