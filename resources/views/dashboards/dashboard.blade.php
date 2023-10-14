<x-app-layout :assets="$assets ?? []">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="d-slider1 overflow-hidden ">
                    <ul class="swiper-wrapper list-inline m-0 p-0 mb-2">
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-01" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                                        <svg class="card-slie-arrow " width="24" height="24px" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Koordinator</p>
                                        <h4 class="counter">{{ $jumlahKoordinator }}</h4>

                                    </div>

                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-02" class="circle-progress-01 circle-progress circle-progress-info text-center" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                        <svg class="card-slie-arrow " width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Calon Pemilih</p>
                                        <h4 class="counter" style="visibility: visible;">{{ $jumlahCalonPemilih }}</h4>

                                    </div>

                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-03" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                        <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Pemilih Tetap</p>
                                        <h4 class="counter" style="visibility: visible;">
                                            {{ $jumlahPemilih }}</h4>
                                    </div>

                                </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-04" class="circle-progress-01 circle-progress circle-progress-info text-center" data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                                        <svg class="card-slie-arrow " width="24px" height="24px" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Akun Terdaftar</p>
                                        <h4 class="counter">{{ $jumlahAkunDcak }}</h4>

                                    </div>

                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" data-aos="fade-up" data-aos-delay="800">
                        <div class="card-header d-flex justify-content-between flex-wrap">
                            <div class="header-title">
                                <h4 class="card-title">Trafik Penginputan Pemilih Selama <span class="jumlah_hari">7</span> Hari
                                    Terakhir</h3>
                                </h4>
                            </div>
                            <div class="d-flex align-items-center align-self-center">
                                <div class="d-flex align-items-center text-primary">
                                </div>
                                <div class="d-flex align-items-center ms-3 text-info" style="display:none !important;">
                                    <div class="dropdown">
                                        <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            Filter: <span class="jumlah_hari">7</span> hari
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton3">
                                            <li><a class="dropdown-item tujuh_hari" href="#" onclick="filterChartPemilih(7)">7 Hari</a></li>
                                            <li><a class="dropdown-item tigapuluh_hari" href="#" onclick="filterChartPemilih(30)">30 Hari</a></li>
                                            <li><a class="dropdown-item sembilanpuluh_hari" href="#" onclick="filterChartPemilih(90)">90 Hari</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            {{-- <div id="d-main" class="d-main"></div> --}}
                            <canvas id="myChart" width="400" height="200"></canvas>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
