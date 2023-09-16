<x-app-layout :assets="$assets ?? []">

    <style>
        #searchResults {
            position: absolute;
            background-color: #fff;
            max-height: 200px;
            overflow-y: auto;
            width: 100vh;
            z-index: 1000;
            border-radius: 5px;
        }

        #searchResults .list-group-item {
            cursor: pointer;
        }

    </style>

    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Pemilih</h4>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <a href="{{ route('input-pemilih') }}">
                                        <button type="button" class="btn btn-primary">Kembali</button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>
                            <span class="text-danger">*</span> Pastikan isi data dengan benar, karena data yang anda isi akan digunakan untuk keperluan pemilihan.
                        </p>
                        <form class="form-horizontal" method="post" action="{{ route('form-input-pencarian-pemilih') }}">

                            @csrf

                            <input type="text" name="id_calon_pemilih" id="id_calon_pemilih">


                            {{-- Nama Koordinator --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="nama_koordinator">Nama Koordinator</label>
                                <div class="col-sm-9">

                                    <input type="text" class="form-control" id="nama_koordinator" name="nama_koordinator" readonly value="{{ $nama_koordinator }}">

                                </div>
                            </div>


                            {{-- Nama PEMILIH --}}
                            <div class="form-group row position-relative">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="nama_pemilih">Nama Pemilih</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_pemilih" class="form-control" id="searchNama" placeholder="Ketik nama untuk mencari...">
                                    <div id="searchResults"></div>
                                </div>
                            </div>


                            {{-- NIK --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="nik">NIK</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="nik" name="nik" placeholder="Masukan NIK">
                                </div>
                            </div>

                            {{-- NO.HP --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="no_hp">NO.HP</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukan Nomor Handphone">

                                </div>
                            </div>


                            {{-- Jenis Kelamin --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="col-sm-9">

                                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" placeholder="Masukan Jenis Kelamin" readonly>

                                </div>
                            </div>

                            {{-- RT --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="rt">RT</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="rt" name="rt" placeholder="Masukan RT" readonly>


                                </div>
                            </div>

                            {{-- RW --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="rt">RW</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="rw" name="rw" placeholder="Masukan RW" readonly>

                                </div>
                            </div>

                            {{-- TPS --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="tps">TPS</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="tps" name="tps" placeholder="Masukan TPS" readonly>


                                </div>
                            </div>


                            {{-- Kelurahan --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="kelurahan">Kelurahan</label>
                                <div class="col-sm-9">

                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Masukan Kelurahan" readonly>

                                </div>
                            </div>


                            <div class="form-group float-end">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                                <button type="button" class="btn btn-danger">cancel</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- --}}
    <script>
        $(document).ready(function() {
            // Fungsi untuk mereset semua field
            function resetFields() {
                $('#jenis_kelamin').val('');
                $('#no_hp').val('');
                $('#rt').val('');
                $('#rw').val('');
                $('#tps').val('');
                $('#kelurahan').val('');
                $('#id_calon_pemilih').val('');
                $('#nik').val('');
            }

            $('#searchNama').on('keyup', function() {
                let query = $(this).val().trim();

                console.log(query);

                if (!query || query.length < 3) {
                    $('#searchResults').empty().hide();
                    resetFields();
                    return;
                }

                $.ajax({
                    url: "{{ route('search.nama') }}"
                    , data: {
                        query: query
                    }
                    , success: function(data) {
                        $('#searchResults').html(data).show();
                    }
                });
            });

            $(document).on('click', '#searchResults .list-group-item', function(e) {
                e.preventDefault();

                let selectedName = $(this).text();
                $('#searchNama').val(selectedName);
                $('#searchResults').empty().hide();

                $.ajax({
                    url: "{{ route('get.pemilih_detail') }}"
                    , data: {
                        nama: selectedName
                    }
                    , success: function(data) {
                        $('#jenis_kelamin').val(data.jenis_kelamin);
                        $('#no_hp').val(data.no_hp);
                        $('#rt').val(data.rt);
                        $('#rw').val(data.rw);
                        $('#tps').val(data.tps);
                        $('#kelurahan').val(data.kelurahan);
                        $('#id_calon_pemilih').val(data.id_calon_pemilih);
                        $('#nik').val(data.nik);
                    }
                });
            });
        });

    </script>






</x-app-layout>
