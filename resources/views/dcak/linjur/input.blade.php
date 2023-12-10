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
                                    <h4 class="card-title">Linjur</h4>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <a href="{{ route('linjur') }}">
                                        <button type="button" class="btn btn-primary">Kembali</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>
                            <span class="text-danger">*</span> Pastikan isi data dengan benar, karena data yang anda isi
                            akan digunakan untuk keperluan pemilihan.
                        </p>
                        <form class="form-horizontal" method="post" action="{{ route('form-input-pencarian-linjur') }}">
                            @csrf
                            <input type="hidden" name="id_calon_pemilih" id="id_calon_pemilih">

                            {{-- Nama Koordinator --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="nama_koordinator">Nama
                                    Koordinator</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_koordinator" name="nama_koordinator" readonly value="{{ $nama_koordinator }}">
                                </div>
                            </div>

                            {{-- Kelurahan --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="kelurahan">Kelurahan</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Pilih Kelurahan" id="kelurahan" name="kelurahan" required>
                                        <option value="" disabled selected>Pilih Kelurahan</option>
                                        @foreach ($kelurahan as $k)
                                        <option value="{{ $k->nama_kelurahan }}">{{ $k->nama_kelurahan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Nama LINJUR --}}
                            <div class="form-group row position-relative">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="nama_pemilih">Nama
                                    Linjur</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_pemilih" class="form-control" id="searchNama" placeholder="Ketik nama untuk mencari..." disabled>
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
                                <label class="control-label col-sm-3 align-self-center mb-0" for="jenis_kelamin">Jenis
                                    Kelamin</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>


                            {{-- RT --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="rt">RT</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="rt" name="rt" placeholder="Masukan RT">
                                </div>
                            </div>

                            {{-- RW --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="rt">RW</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="rw" name="rw" placeholder="Masukan RW">
                                </div>
                            </div>

                            {{-- TPS --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="tps">TPS</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="tps" name="tps" placeholder="Masukan TPS">
                                </div>
                            </div>

                            <div class="form-group float-end">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        // Fungsi untuk menyimpan data ke IndexedDB
        function saveToIndexedDB(kelurahan, data) {
            let transaction = db.transaction(["kelurahanData"], "readwrite");
            let store = transaction.objectStore("kelurahanData");
            store.put({
                kelurahan: kelurahan
                , data: data
            });
        }

        // Fungsi untuk mengambil data dari IndexedDB
        function getFromIndexedDB(kelurahan, callback) {
            let transaction = db.transaction(["kelurahanData"]);
            let store = transaction.objectStore("kelurahanData");
            let request = store.get(kelurahan);

            request.onerror = function(event) {
                console.log("Error fetching data from IndexedDB", event.target.errorCode);
            };

            request.onsuccess = function(event) {
                callback(event.target.result ? event.target.result.data : null);
            };
        }

        $(document).ready(function() {
            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this
                        , args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }

            function loadNamesByKelurahan(kelurahan) {
                getFromIndexedDB(kelurahan, function(data) {
                    if (data) {
                        handleDataResponse(data);
                    } else {
                        $.ajax({
                            url: "{{ route('search.nama-linjur') }}"
                            , data: {
                                kelurahan: kelurahan
                            }
                            , success: function(data) {
                                saveToIndexedDB(kelurahan, data);
                                handleDataResponse(data);
                            }
                            , error: function() {
                                alert('Error loading data. Please try again later.');
                            }
                        });
                    }
                });
            }

            function handleDataResponse(data) {
                var $data = $(data);
                if ($data.find('.list-group-item').length > 0) {
                    $('#searchNama').prop('disabled', false);
                } else {
                    $('#searchNama').prop('disabled', true);
                    alert('No names found for selected kelurahan.');
                }
            }

            $('#kelurahan').change(function() {
                let selectedKelurahan = $(this).val();
                $('#searchNama').prop('disabled', true).val('');
                $('#searchResults').empty().hide();
                loadNamesByKelurahan(selectedKelurahan);
            });

            $('#searchNama').on('input', debounce(function() {
                let query = $(this).val().trim().toLowerCase();
                if (query.length < 3) {
                    $('#searchResults').empty().hide();
                    return;
                }
                let kelurahan = $('#kelurahan').val();
                getFromIndexedDB(kelurahan, function(data) {
                    if (data) {
                        let $html = $(data);
                        $html.find('.list-group-item').hide();
                        $html.find('.list-group-item').filter(function() {
                            return $(this).text().toLowerCase().includes(query);
                        }).show();
                        $('#searchResults').html($html.html()).show();
                    } else {
                        $('#searchResults').html('<div class="list-group-item">No data available</div>').show();
                    }
                });
            }, 250));

            $(document).on('click', '#searchResults .list-group-item', function(e) {
                e.preventDefault();
                let selectedName = $(this).text();
                $('#searchNama').val(selectedName);
                let selectedKelurahan = $('#kelurahan').val();

                $('#searchResults').empty().hide();

                $.ajax({
                    url: "{{ route('get-linjur-detail') }}"
                    , data: {
                        nama: selectedName
                        , kelurahan: selectedKelurahan
                    }
                    , success: function(data) {
                        console.log(data);
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
