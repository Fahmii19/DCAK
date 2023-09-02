<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Koordinator</h4>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <a href="{{ route('koordinator') }}">
                                        <button type="button" class="btn btn-primary"> Kembali</button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>
                            <span class="text-danger">*</span> Pastikan isi data dengan benar, karena data yang anda isi akan digunakan untuk keperluan pemilihan.
                        </p>
                        <form class="form-horizontal" method="post" action="{{ route('form-input-koordinator') }}">
                            @csrf

                            {{-- Nama Koordinator --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="nama_koordinator">Nama Koordinator</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_koordinator" name="nama_koordinator" placeholder="Masukan Nama Koordinator" required>
                                </div>
                            </div>

                            <div class="form-group float-end">

                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-danger">cancel</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- --}}
    <script></script>

</x-app-layout>
