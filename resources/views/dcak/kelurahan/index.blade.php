<x-app-layout :assets="$assets ?? []">

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Kelurahan</h4>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <a href="{{ route('input-kelurahan') }}" class="d-inline-block">
                                    <button type="button" class="btn btn-success">Tambah Data</button>
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        Data ini menampilkan kelurahan yang telah terdaftar.
                    </p>
                    <div class="">
                        <table id="datatableKelurahan" class="table table-striped dt-responsive nowrap" data-toggle="data-table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelurahan</th>
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

            if ($.fn.dataTable.isDataTable('#datatableKelurahan')) {
                $('#datatableKelurahan').DataTable().destroy();
            }

            $('#datatableKelurahan').DataTable({
                processing: true
                , destroy: true
                , responsive: true
                , serverSide: true
                , ajax: '{{ route("table-kelurahan") }}'
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
                        data: 'nama_kelurahan'
                        , name: 'nama_kelurahan'
                    }

                , ]
                , order: [0, 'desc']


            });
        });

    </script>




</x-app-layout>
