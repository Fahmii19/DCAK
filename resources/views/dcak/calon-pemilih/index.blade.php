<x-app-layout :assets="$assets ?? []">

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
                    <div class="">
                        <table id="datatableCalonPemilih" class="table table-striped dt-responsive nowrap" data-toggle="data-table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Pemilih</th>
                                    <th>No HP</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>TPS</th>
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
                        data: 'id_pemilih'
                        , name: 'id_pemilih'
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
                , ]
                , order: [0, 'desc']


            });
        });

    </script>




</x-app-layout>
