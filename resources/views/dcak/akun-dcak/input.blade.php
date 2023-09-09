<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Akun DCAK</h4>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <a href="{{ route('akun-dcak') }}">
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
                        <form class="form-horizontal" method="post" action="{{ route('form-input-akun-dcak') }}">
                            @csrf

                            {{-- Nama Koordinator --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="koordinator">Koordinator</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" name="koordinator" id="koordinator">
                                        <option value="" disabled selected>Pilih Koordinator</option>
                                        @foreach($koordinator as $k)
                                        <option value="{{ $k->id_koordinator }}">{{ $k->nama_koordinator }} - {{ $k->kelurahan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Select level --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="level">Level</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" name="level" id="level">
                                        <option value="" disabled selected>Pilih Level</option>
                                        <option value="Admin">Admin</option>
                                        <option value="SuperAdmin">SuperAdmin</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Username --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="username">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" required>
                                </div>
                            </div>

                            {{-- Passowrd --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="password">Password</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="password" name="password" placeholder="Masukan Password" required>
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
