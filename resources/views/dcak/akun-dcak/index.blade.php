<x-app-layout :assets="$assets ?? []">

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
                    <div class="">
                        <table id="datatableAkunDcak" class="table table-striped dt-responsive nowrap" data-toggle="data-table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Koordinator</th>
                                    <th>Kelurahan</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Level</th>

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
                        data: 'koordinator.nama_koordinator',
                        name: 'koordinator.nama_koordinator',
                        "defaultContent": "N/A"
                    },
                    {
                        data: 'koordinator.kelurahan',
                        name: 'koordinator.kelurahan',
                        "defaultContent": "N/A"
                    },
                    {
                        data: 'username'
                        , name: 'username'
                    },

                    {
                        data: 'password'
                        , name: 'password'
                    },
                    {
                        data: 'level'
                        , name: 'level'
                    }
                , ]
                , order: [0, 'desc']


            });
        });

    </script>




</x-app-layout>
