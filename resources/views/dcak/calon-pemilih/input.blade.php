<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Calon Pemilih</h4>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <a href="{{ route('calon-pemilih') }}">
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
                        <form class="form-horizontal" method="post" action="{{ route('form-input-calon-pemilih') }}">
                            @csrf

                            {{-- Nama PEMILIH --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="nama_pemilih">Nama Pemilih</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_pemilih" name="nama_pemilih" placeholder="Masukan Nama Pemilih" required>
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" name="jenis_kelamin" id="jenis_kelamin" required>
                                        <option selected>Pilih Jenis Kelamin</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>

                                    </select>
                                </div>
                            </div>


                            {{-- NO.HP --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="no_hp">NO.HP</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukan Nomor Handphone" required>

                                </div>
                            </div>


                            {{-- RT --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="rt">RT</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="rt" name="rt" placeholder="Masukan RT" required>

                                </div>
                            </div>

                            {{-- RW --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="rt">RW</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="rw" name="rw" placeholder="Masukan RW" required>
                                </div>
                            </div>

                            {{-- TPS --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="tps">TPS</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="tps" name="tps" placeholder="Masukan TPS" required>

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
