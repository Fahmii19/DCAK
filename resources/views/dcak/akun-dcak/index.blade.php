<x-app-layout :assets="$assets ?? []">

    <style>
        #showModalAkundcak .modal-content {
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
                                <h4 class="card-title">Akun DCAK</h4>
                            </div>
                            <div class="col-md-6 text-md-end">

                                <a href="{{ route('input-akun-dcak') }}" class="d-inline-block">
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
                        <table id="datatableAkunDcak" class="table table-striped dt-responsive nowrap" data-toggle="data-table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Koordinator</th>
                                    <th>Kelurahan</th>
                                    <th>Username</th>
                                    <th>Level</th>
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


    <div class="modal fade" id="showModalAkundcak" tabindex="-1" aria-labelledby="ModalAkundcak" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAkundcak">Modal title</h5>
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


            if ($.fn.dataTable.isDataTable('#datatableAkunDcak')) {
                $('#datatableAkunDcak').DataTable().destroy();
            }

            $('#datatableAkunDcak').DataTable({
                processing: true
                , destroy: true
                , responsive: true
                , serverSide: true
                , ajax: '{{ route("table-akun-dcak") }}'
                , columns: [

                    {
                        data: 'id_users_dcak'
                        , name: 'id_users_dcak'
                    },

                    {
                        data: 'koordinator.nama_koordinator'
                        , name: 'koordinator.nama_koordinator'
                        , "defaultContent": "N/A"
                    }
                    , {
                        data: 'koordinator.kelurahan'
                        , name: 'koordinator.kelurahan'
                        , "defaultContent": "N/A"
                    }
                    , {
                        data: 'username'
                        , name: 'username'
                    },

                    {
                        data: 'level'
                        , name: 'level'
                    },

                    {
                        data: 'id_users_dcak'
                        , name: 'id_users_dcak'
                        , render: function(data, type, row) {
                            return `
                           <button onclick="editAkundcak(${data})" class="btn btn-warning btn-sm">Edit</button>
                           <button onclick="hapusAkundcak(${data})" class="btn btn-danger btn-sm">Hapus</button>
                           `;
                        }
                    }




                , ]
                , order: [0, 'desc']


            });
        });


        function editAkundcak(id) {
            $.get(`/edit-akundcak/${id}`)
                .done(function(data) {

                    let id_koordinator = data.koordinator.id_koordinator;

                    $('#ModalAkundcak').text('Edit Akundcak');
                    $('#showModalAkundcak .modal-body').html(`
                    <form id="updateAkundcakForm" action="/form-edit-akundcak/${id}" method="post">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="id" value="${id}">
                        <input type="hidden" name="id_koordinator" value="${id_koordinator}">

                        <div class="mb-3">
                            <label>Nama Koordinator</label>
                            <input type="text" name="nama_koordinator" class="form-control" value="${data.koordinator.nama_koordinator}">
                        </div>

                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="${data.username}">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" placeholder="Password baru">
                        </div>

                        <div class="mb-3">
                            <label>Level</label>
                            <select class="form-select" aria-label="Default select example" name="level" id="level" required>
                                <option value="" disabled selected>Pilih Level</option>
                                <option value="admin">Admin</option>
                                <option value="superadmin">Superadmin</option>
                            </select>
                        </div>

                        <div class="form-group float-end">
                            <button type="button" id="modalSimpanAkundcak" class="btn btn-primary">Simpan</button>

                        </div>


                    </form>
                    `);

                    // Select option
                    if (data.level === 'admin') {
                        $('#level').val('admin');
                    } else if (data.level === 'superadmin') {
                        $('#level').val('superadmin');

                    }


                    $('#showModalAkundcak').modal('show');
                    $('#modalSimpanAkundcak').off('click').click(function() {
                        $('#updateAkundcakForm').submit();
                    });
                })
                .fail(function() {
                    alert('Failed to fetch data. Please try again.');
                });
        }

        function hapusAkundcak(id) {
            if (confirm("Apakah Anda yakin ingin menghapus akundcak ini?")) {
                $.ajax({
                    url: `/delete-akundcak/${id}`
                    , method: 'DELETE'
                    , data: {
                        _token: '{{ csrf_token() }}'
                    }
                    , success: function(response) {
                        $('#datatableAkundcak').DataTable().ajax.reload();
                    }
                });
            }
        }

    </script>




</x-app-layout>
