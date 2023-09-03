<x-app-layout :assets="$assets ?? []">

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
                    <div class="">
                        <table id="datatableKoordinator" class="table table-striped dt-responsive nowrap" data-toggle="data-table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kepala</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Jumlah Surat Dukungan</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
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


            if ($.fn.dataTable.isDataTable('#datatableKoordinator')) {
                $('#datatableKoordinator').DataTable().destroy();
            }

            $('#datatableKoordinator').DataTable({
                processing: true
                , destroy: true
                , responsive: true
                , serverSide: true
                , ajax: '{{ route("table-koordinator") }}'
                , columns: [

                    {
                        data: 'id_koordinator'
                        , name: 'id_koordinator'
                    },

                    {
                        data: 'nama_koordinator'
                        , name: 'nama_koordinator'
                    }
                    , {
                        data: 'username'
                        , name: 'username'
                    },

                    {
                        data: 'password'
                        , name: 'password'
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

                , ]
                , order: [0, 'desc']


            });
        });

    </script>




</x-app-layout>
