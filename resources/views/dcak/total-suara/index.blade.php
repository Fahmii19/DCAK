<x-app-layout :assets="$assets ?? []">

    <style>
        #showModalKoordinator .modal-content {
            color: black;
        }

    </style>



    <div class="row">
        @foreach($jumlahPemilihPerKelurahanPerkecamatan as $kecamatan => $kelurahans)

        <div class="col-md-12 col-xl-4">
            <div class="card aos-init aos-animate" data-aos="fade-up" data-aos-delay="900">
                <div class="flex-wrap card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">{{ $kecamatan }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-grid gap col-md-5 col-lg-7">
                        @foreach($kelurahans as $kelurahan => $jumlah)
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
        <div class="col-md-12 col-xl-4">
            <div class="card aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
                <div class="flex-wrap card-header d-flex justify-content-center">
                    <div class="header-title">
                        <h4 class="card-title">Total Perkecamatan</h4>
                    </div>
                </div>

                <div class="text-center card-body d-flex justify-content-around">
                    @foreach ($jumlahTotalPerKecamatan as $kecamatan => $totalPemilih)

                    <div>
                        <h2 class="mb-2">{{ number_format($totalPemilih) }}</small></h2>
                        <p class="mb-0 text-gray">{{ $kecamatan }}</p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


</x-app-layout>
