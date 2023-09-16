<x-app-layout :assets="$assets ?? []">

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Pemilih</h4>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <a href="{{ route('input-pemilih') }}" class="d-inline-block">
                                    <button type="button" class="btn btn-success">Tambah Data</button>
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
                        <table id="datatablePemilih" class="table table-striped dt-responsive nowrap" data-toggle="data-table">

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

            if ($.fn.dataTable.isDataTable('#datatablePemilih')) {
                $('#datatablePemilih').DataTable().destroy();
            }

            $('#datatablePemilih').DataTable({
                processing: true
                , destroy: true
                , responsive: true
                , serverSide: true
                , ajax: '{{ route("table-pemilih") }}'
                , columns: [

                    {
                        data: 'id_pemilih'
                        , name: 'id_pemilih'
                    }
                    , {
                        data: 'nama_koordinator'
                        , name: 'nama_koordinator'
                    }
                    , {
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
                , ]
                , order: [0, 'desc']


            });
        });

    </script>




</x-app-layout>
