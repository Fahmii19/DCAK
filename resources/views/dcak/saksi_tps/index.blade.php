<x-app-layout :assets="$assets ?? []">

    <style>
        #showModalSaksiTPS .modal-content {
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
                                <h4 class="card-title">Saksi TPS</h4>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <form action="{{ route('import-saksi-tps') }}" method="POST"
                                    enctype="multipart/form-data" class="d-inline-block">
                                    @csrf
                                    <input type="file" name="excel_file" id="excel_file" required
                                        onchange="this.form.submit();" style="display:none;">

                                    <button type="button" class="btn btn-primary" id="activateInput">Import Data
                                        Excel</button>
                                </form>

                                <a href="{{ route('input-saksi-tps') }}" class="d-inline-block">
                                    <button type="button" class="btn btn-success">Tambah Data</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        Data ini menampilkan saksi TPS yang telah terdaftar.
                    </p>
                    <div class="table-responsive">
                        <table id="datatableSaksiTPS" class="table table-striped dt-responsive nowrap"
                            data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Saksi</th>
                                    <th>NIK</th>
                                    <th>NO HP</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>NO TPS</th>
                                    <th>KELURAHAN</th>
                                    <th>KECAMATAN</th>
                                    <th>JUMLAH SUARA DI TPS</th>
                                    <th>GAMBAR</th>
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

    <!-- Edit Saksi TPS Modal -->
    <div class="modal fade" id="showModalSaksiTPS" tabindex="-1" aria-labelledby="ModalSaksiTPS" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalSaksiTPS">Edit Saksi TPS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editSaksiTPSForm">
                        @csrf
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                        </div>
                        <div class="mb-3">
                            <label for="rt" class="form-label">RT</label>
                            <input type="text" class="form-control" id="rt" name="rt" required>
                        </div>
                        <div class="mb-3">
                            <label for="rw" class="form-label">RW</label>
                            <input type="text" class="form-control" id="rw" name="rw" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" required>
                        </div>
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_suara" class="form-label">Jumlah Suara</label>
                            <input type="number" class="form-control" id="jumlah_suara" name="jumlah_suara" required>
                        </div>
                        <!-- You need to handle file uploads appropriately -->
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" required>
                        </div>
                        <img id="editImage" src="" width="100" height="100" alt="Saksi TPS Image">


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
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

            if ($.fn.dataTable.isDataTable('#datatableSaksiTPS')) {
                $('#datatableSaksiTPS').DataTable().destroy();
            }

            $('#datatableSaksiTPS').DataTable({
                processing: true,
                destroy: true,
                responsive: true,
                serverSide: true,
                ajax: '{{ route('table-saksi-tps') }}',
                columns: [{
                    data: 'id_saksi_tps',
                    name: 'id_saksi_tps'
                }, {
                    data: 'nama_saksi',
                    name: 'nama_saksi'
                }, {
                    data: 'nik',
                    name: 'nik'
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
                    data: 'no_tps',
                    name: 'no_tps'
                }, {
                    data: 'kelurahan',
                    name: 'kelurahan'
                }, {
                    data: 'kecamatan',
                    name: 'kecamatan'
                }, {
                    data: 'jumlah_suara',
                    name: 'jumlah_suara'
                }, {
                    data: 'gambar',
                    name: 'gambar',
                    render: function(data, type, row) {
                        if (data) {
                            return `<img src="{{ asset('images/saksi_tps') }}/${data}" width="50" height="50" />`;
                        } else {
                            return `<img src='{{ asset('asset-login-dcak/images/not-image.jpg') }}' width="50" height="50" />`;
                        }
                    }
                }, {


                    data: 'id_saksi_tps',
                    name: 'id_saksi_tps',
                    render: function(data, type, row) {
                        return `
                        <button onclick="editSaksiTPS(${data})" class="btn btn-warning btn-sm">Edit</button>
                        <button onclick="hapusSaksiTPS(${data})" class="btn btn-danger btn-sm">Hapus</button>
                        `;
                    }
                }],
                order: [
                    [0, 'desc']
                ]
            });


        });

        // Edit Saksi TPS
        function editSaksiTPS(id) {
            $.get(`/edit-saksi-tps/${id}`)
                .done(function(data) {
                    $('#ModalSaksiTPS').text('Edit Saksi TPS');

                    $('#nik').val(data.nik);

                    $('#nama_saksi').val(data.nama_saksi);
                    $('#no_hp').val(data.no_hp);
                    $('#rt').val(data.rt);
                    $('#rw').val(data.rw);
                    $('#no_tps').val(data.no_tps);
                    $('#kelurahan').val(data.kelurahan);
                    $('#kecamatan').val(data.kecamatan);
                    $('#jumlah_suara').val(data.jumlah_suara);
                    // $('#gambar').val(data.gambar);

                    if (data.gambar) {
                        $('#editImage').attr('src', `{{ asset('images/saksi_tps') }}/${data.gambar}`);
                    } else {
                        $('#editImage').attr('src',
                        `{{ asset('asset-login-dcak/images/not-image.jpg') }}`); // Sesuaikan dengan path gambar default jika tidak ada gambar


                    }


                    $('#showModalSaksiTPS').modal('show');

                    $('#saveChanges').off('click').click(function() {
                        var form = $('#editSaksiTPSForm')[0];
                        var formData = new FormData(form);

                        $.ajax({
                            url: `/form-edit-saksi-tps/${id}`,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert('Data updated successfully');
                                    $('#datatableSaksiTPS').DataTable().ajax.reload();
                                    $('#showModalSaksiTPS').modal('hide');
                                } else {
                                    alert('Failed to update data');
                                }
                            },
                            error: function() {
                                alert('Failed to send data. Please try again.');
                            }
                        });
                    });


                })
                .fail(function() {
                    alert('Failed to fetch data. Please try again.');
                });
        }


        // Hapus Saksi TPS
        function hapusSaksiTPS(id) {
            if (confirm("Apakah Anda yakin ingin menghapus saksi TPS ini?")) {
                $.ajax({
                    url: `/delete-saksi-tps/${id}`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Data saksi TPS berhasil dihapus.');
                            $('#datatableSaksiTPS').DataTable().ajax.reload();
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
