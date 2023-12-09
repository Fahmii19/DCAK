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
                                    <a href="{{ route('input-linjur') }}">
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
                        <form class="form-horizontal" method="post" action="{{ route('form-input-pencarian-linjur') }}">
                            @csrf
                            <input type="hidden" name="id_calon_pemilih" id="id_calon_pemilih">

                            {{-- Nama Koordinator --}}
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="nama_koordinator">Nama Koordinator</label>
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
                                        @foreach($kelurahan as $k)
                                        <option value="{{ $k->nama_kelurahan }}">{{ $k->nama_kelurahan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Nama LINJUR --}}
                            <div class="form-group row position-relative">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="nama_pemilih">Nama Linjur</label>
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
                                <label class="control-label col-sm-3 align-self-center mb-0" for="jenis_kelamin">Jenis Kelamin</label>
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
        $(document).ready(function() {
            let kelurahanDataCache = {}; // Cache untuk menyimpan data berdasarkan kelurahan

            // Fungsi untuk memuat nama-nama berdasarkan kelurahan
            function loadNamesByKelurahan(kelurahan) {
                if (kelurahanDataCache[kelurahan]) {
                    // Gunakan data dari cache jika tersedia
                    handleDataResponse(kelurahanDataCache[kelurahan]);
                } else {
                    // Request AJAX untuk mendapatkan data
                    $.ajax({
                        url: "{{ route('search.nama-linjur') }}"
                        , data: {
                            kelurahan: kelurahan
                        }
                        , success: function(data) {
                            kelurahanDataCache[kelurahan] = data; // Simpan respons ke cache
                            handleDataResponse(data);
                        }
                        , error: function() {
                            alert('Error loading data. Please try again later.');
                        }
                    });
                }
            }

            // Fungsi untuk menangani respons data
            function handleDataResponse(data) {
                // Membuat elemen jQuery dari string HTML
                var $data = $(data);

                // Mengecek apakah ada data pemilih
                if ($data.find('.list-group-item').length > 0 && $data.find('.list-group-item').text().trim() !== "Tidak ada data pemilih") {
                    $('#searchNama').prop('disabled', false);
                } else {
                    $('#searchNama').prop('disabled', true);
                    alert('No names found for selected kelurahan.');
                }
            }

            // Event handler ketika kelurahan dipilih
            $('#kelurahan').change(function() {
                let selectedKelurahan = $(this).val();
                $('#searchNama').prop('disabled', true).val(''); // Nonaktifkan dan bersihkan field pencarian
                $('#searchResults').empty().hide(); // Bersihkan hasil pencarian sebelumnya
                loadNamesByKelurahan(selectedKelurahan);
            });

            // Event handler untuk pencarian nama
            $('#searchNama').on('keyup', function() {
                let query = $(this).val().trim().toLowerCase();
                if (!query || query.length < 3) {
                    $('#searchResults').empty().hide();
                    return;
                }
                let kelurahan = $('#kelurahan').val();
                let dataHTML = kelurahanDataCache[kelurahan];
                if (dataHTML) { // Menciptakan elemen jQuery dari string HTML
                    let $html = $(dataHTML); // Menyembunyikan semua item yang tidak cocok
                    $html.each(function() {
                        let $item = $(this);
                        if ($item.text().toLowerCase().includes(query)) {
                            $item.show();
                        } else {
                            $item.hide();
                        }
                    }); // Menampilkan hasil yang sudah difilter
                    $('#searchResults').html($html).show();
                } else { // Tampilkan pesan jika tidak ada data
                    $('#searchResults').html('<div class="list-group-item">No data available</div>').show();
                }
            });

            // Fungsi untuk reset field
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

            // Gabungan event handler untuk pemilihan nama dari hasil pencarian
            $(document).on('click', '#searchResults .list-group-item', function(e) {
                e.preventDefault();

                let selectedName = $(this).text();
                let selectedKelurahan = $('#kelurahan').val(); // Mendapatkan nilai kelurahan yang dipilih


                $('#searchNama').val(selectedName);
                $('#searchResults').empty().hide();

                // Melakukan AJAX request untuk mendapatkan detail lebih lanjut
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
