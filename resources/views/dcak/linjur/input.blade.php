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
        let enteredNames = []; // Penyimpanan nama yang telah diinput
        let enteredIds = []; // Penyimpanan id yang telah diinput

        // Fungsi untuk menyimpan data ke localStorage
        function saveToLocalStorage(kelurahan, data) {
            let oldData = JSON.parse(localStorage.getItem(kelurahan)) || [];

            // Gabungkan data lama dengan data baru
            let combinedData = [...oldData, {
                kelurahan: kelurahan
                , data: data
            }];

            // Simpan data ke localStorage
            localStorage.setItem(kelurahan, JSON.stringify(combinedData));
        }

        // Definisi fungsi getFromLocalStorage
        function getFromLocalStorage(kelurahan, callback) {
            let data = JSON.parse(localStorage.getItem(kelurahan));
            callback(data ? data[data.length - 1].data : null);
        }

        // Definisi fungsi filterDataExcludeEnteredIds untuk menghandle string HTML
        function filterDataExcludeEnteredIds(htmlData, enteredIds) {
            var $items = $(htmlData).filter('.list-group-item');
            return $items.filter(function() {
                var id = $(this).data('id'); // Pastikan elemen HTML memiliki atribut data-id
                return !enteredIds.includes(id);
            });
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

            function loadNamesByKelurahan(kelurahan, query) {
                if (query.length < 3) {
                    $('#searchResults').empty().hide();
                    return;
                }

                getFromLocalStorage(kelurahan, function(data) {
                    if (data) {
                        let $data = $(data);
                        let $items = $data.find('.list-group-item');

                        let filteredData = $items.filter(function() {
                            let itemText = $(this).text();
                            return itemText.toLowerCase().includes(query) && !enteredNames.includes(itemText);
                        });


                        handleDataResponse(filteredData);
                    } else {
                        $.ajax({
                            url: "{{ route('search.nama-linjur') }}"
                            , data: {
                                kelurahan: kelurahan
                                , query: query
                                , excludedIds: enteredIds
                            }
                            , success: function(data) {
                                saveToLocalStorage(kelurahan, data);
                                let filteredData = data.filter(function(item) {
                                    return item.name.toLowerCase().includes(query) && !enteredNames.includes(item.name);
                                });
                                handleDataResponse(filteredData);
                            }
                            , error: function() {
                                alert('Error loading data. Please try again later.');
                            }
                        });
                    }
                });

                // ... (Kode lainnya tetap sama)
            }

            function handleDataResponse(filteredData) {
                var $data = $(filteredData);
                if ($data.length > 0) {
                    $('#searchNama').prop('disabled', false);

                    // Mengosongkan container hasil sebelumnya
                    $('#searchResults').empty();

                    // Menambahkan setiap item yang difilter ke dalam container hasil
                    $data.each(function() {
                        $('#searchResults').append($(this).clone()); // Menambahkan item ke dalam hasil pencarian
                    });

                    $('#searchResults').show();
                } else {
                    $('#searchNama').prop('disabled', true);
                    $('#searchResults').empty().hide();
                    alert('No names found for the entered keyword.');
                }
            }

            $('#kelurahan').change(function() {
                let selectedKelurahan = $(this).val();
                $('#searchNama').prop('disabled', selectedKelurahan ? false : true).val('');
                $('#searchResults').empty().hide();
            });

            $('#searchNama').on('input', debounce(function() {
                let query = $(this).val().trim().toLowerCase();
                let kelurahan = $('#kelurahan').val();

                if (kelurahan) {
                    loadNamesByKelurahan(kelurahan, query);
                }
            }, 250));

            $(document).on('click', '#searchResults .list-group-item', function(e) {
                e.preventDefault();

                let fullText = $(this).text();
                let parts = fullText.split(' - ');
                let selectedName = parts[0];
                let rt = parts[1].split(': ')[1];
                let rw = parts[2].split(': ')[1];
                let tps = parts[3].split(': ')[1];

                $('#searchNama').val(selectedName);
                let selectedKelurahan = $('#kelurahan').val();

                // Menyimpan nama yang telah diinput
                enteredNames.push(selectedName);

                $('#searchResults').empty().hide();

                $.ajax({
                    url: "{{ route('get-linjur-detail') }}"
                    , data: {
                        nama: selectedName
                        , kelurahan: selectedKelurahan
                        , rt: rt
                        , rw: rw
                        , tps: tps
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
