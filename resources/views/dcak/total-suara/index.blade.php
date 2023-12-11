<x-app-layout :assets="$assets ?? []">

    <style>
        #showModalKoordinator .modal-content {
            color: black;
        }
    </style>



    <div class="row">
        @foreach ($jumlahPemilihPerKelurahanPerkecamatan as $kecamatan => $kelurahans)
            <div class="col-md-12 col-xl-6">
                <div class="card aos-init aos-animate" data-aos="fade-up" data-aos-delay="900">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">

                            <h4 class="card-title">Total Surat Suara {{ $kecamatan }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap col-md-5 col-lg-5">
                            @foreach ($kelurahans as $kelurahan => $jumlah)
                                <div class="flex-wrap d-flex justify-content-between">
                                    <div><span class="text-gray">{{ $kelurahan }}</span></div>
                                    <div>
                                        <h6>{{ $jumlah }}</h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>





    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


</x-app-layout>
