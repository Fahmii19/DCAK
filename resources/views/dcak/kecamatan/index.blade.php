<x-app-layout :assets="$assets ?? []">

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Kecamatan</h4>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <a href="{{ route('input-kecamatan') }}" class="d-inline-block">
                                    <button type="button" class="btn btn-success">Tambah Data</button>
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        Data ini menampilkan kecamatan yang telah terdaftar.
                    </p>
                    <div class="">
                        <table id="datatableKecamatan" class="table table-striped dt-responsive nowrap" data-toggle="data-table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kecamatan</th>
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

            if ($.fn.dataTable.isDataTable('#datatableKecamatan')) {
                $('#datatableKecamatan').DataTable().destroy();
            }

            $('#datatableKecamatan').DataTable({
                processing: true
                , destroy: true
                , responsive: true
                , serverSide: true
                , ajax: '{{ route("table-kecamatan") }}'
                , columns: [

                    {
                        data: 'id_kecamatan'
                        , name: 'id_kecamatan'
                    },

                    {
                        data: 'nama_kecamatan'
                        , name: 'nama_kecamatan'
                    }

                , ]
                , order: [0, 'desc']


            });
        });

    </script>




</x-app-layout>
