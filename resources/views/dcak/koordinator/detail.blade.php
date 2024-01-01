<x-app-layout :assets="$assets ?? []">

    <style>
        #showModalKoordinator .modal-content {
            color: black;
        }

    </style>

    <!-- Add a section to display Koordinator and Pemilih details -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Detail Koordinator</h4>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <button onclick="window.location='{{ url('ekspor-pdf-koordinator',$koordinator->id_koordinator) }}'" class="btn btn-primary">Ekspor ke PDF</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding-top: 0 !important;">
                    {{-- --}}

                    <p class="mt-2">Nama Koordinator: {{ $koordinator->nama_koordinator }}</p>
                    <p>Kelurahan: {{ $koordinator->kelurahan }}</p>
                    <p>Kecamatan: {{ $koordinator->kecamatan }}</p>
                    <p>Jumlah Surat Dukungan: {{ $koordinator->jumlah_surat_dukungan }}</p>
                    <p>Total Input: {{ $pemilihRecords->count() }}</p>


                    {{-- --}}
                    <div class="table-responsive">
                        <table id="datatableKoordinator" class="table table-striped dt-responsive nowrap" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Koordinator</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>RW</th>
                                    <th>RT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemilihRecords as $key => $pemilih)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $pemilih->nama_pemilih }}</td>
                                    <td>{{ $pemilih->kelurahan }}</td>
                                    <td>{{ $pemilih->kecamatan }}</td>
                                    <td>{{ $pemilih->rw }}</td>
                                    <td>{{ $pemilih->rt }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
