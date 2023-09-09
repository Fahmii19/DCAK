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

                            {{-- Jumlah Surat Dukungan --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="jumlah_surat_dukungan">Jumlah Surat Dukungan</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="jumlah_surat_dukungan" name="jumlah_surat_dukungan" placeholder="Masukan Jumlah Surat Dukungan" required>
                                </div>
                            </div>

                            {{-- Kelurahan --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="kelurahan">Kelurahan</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" name="kelurahan" id="kelurahan" required>
                                        <option value="" disabled selected>Pilih Kelurahan</option>
                                        @foreach($kelurahan as $k)
                                        <option value="{{ $k->nama_kelurahan }}">{{ $k->nama_kelurahan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Kecamatan --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="kecamatan">Kecamatan</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" name="kecamatan" id="kecamatan" required>
                                        <option value="" disabled selected>Pilih Kecamatan</option>
                                        @foreach($kecamatan as $k)
                                        <option value="{{ $k->nama_kecamatan }}">{{ $k->nama_kecamatan }}</option>
                                        @endforeach
                                    </select>
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
