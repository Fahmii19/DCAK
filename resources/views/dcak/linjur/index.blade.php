<x-app-layout :assets="$assets ?? []">

    <style>
        #showModalLinjur .modal-content {
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
                                <h4 class="card-title">Linjur</h4>
                            </div>
                            <div class="col-md-6 d-flex justify-content-md-end align-items-center custom-mt">

                                <a href="{{ route('input-linjur') }}" class="d-inline-block">
                                    <button type="button" class="btn btn-success">Tambah Data</button>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        Data ini menampilkan linjur yang telah terdaftar.
                    </p>
                    <div class="table-responsive">
                        <table id="datatableLinjur" class="table table-striped dt-responsive nowrap" data-toggle="data-table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Koordinator</th>
                                    <th>NIK</th>
                                    <th>Nama Linjur</th>
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

    <div class="modal fade" id="showModalLinjur" tabindex="-1" aria-labelledby="ModalLinjur" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLinjur">Modal title</h5>
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

            document.getElementById("activateInputLinjur").addEventListener("click", function() {
                document.getElementById("excel_file_linjur").click();
            });

            if ($.fn.dataTable.isDataTable('#datatableLinjur')) {
                $('#datatableLinjur').DataTable().destroy();
            }

            $('#datatableLinjur').DataTable({
                processing: true
                , destroy: true
                , responsive: true
                , serverSide: true
                , ajax: '{{ route("table-linjur") }}'
                , columns: [
                    // Columns configuration remains unchanged

                ]
                , order: [0, 'desc']

            });
        });

        function editLinjur(id) {
            // Function remains unchanged
        }

        function hapusLinjur(id) {
            // Function remains unchanged
        }

    </script>

</x-app-layout>
