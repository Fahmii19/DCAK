@extends('landing-page.komponen.partial')

@section( 'content')
<!-- start hero -->
<section class="hero-1 bg-white position-relative d-flex align-items-center justify-content-center overflow-hidden" style="background-image: url(images/hero-1-bg.png)" id="home">
    <div class="container">
        <div class="row align-items-center text-center text-lg-start">
            <div class="col-lg-6 mt-4 pt-2">
                <h6 class="text-primary mb-3">Membangun Konektivitas dengan Anda</h6>
                <h1 class="ml11 mb-2">
                    <span class="text-wrapper">
                        <span class="line line1"></span>
                        <span class="letters pb-0">Visi 4KSI </span>
                    </span>
                </h1>
                <h5 class="my-4">HJ. Abdul Khoir S.T. - Katalis Inovasi Sistem Informasi</h5>

                <p class="text-muted mb-2">
                    Menyajikan solusi inovatif dalam dunia Sistem Informasi. Membawa perubahan yang positif dengan platform yang mudah diakses dan berintegritas tinggi, menjawab kebutuhan Anda dalam era digital ini.
                </p>
                <a href="#" class="btn btn-primary mt-4">Bergabunglah dengan Visi Kami
                    <i data-feather="arrow-right" class="icon-xs icon"></i>
                </a>
            </div>
            <div class="col-lg-6 mt-lg-4 pt-2 mt-5">
                <img class="hero-img" src="{{ asset('assets_landing/images/bg.jpg') }}" alt="Abdul Khoir S.T. Visi" style="width: 55vh; margin-left: 18vh;" />
            </div>
        </div>
    </div>
    <!-- end container -->
</section>


<!-- end hero -->



<!-- start feature -->
<section class="section bg-light overflow-hidden" id="feature">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img class="img-container" src="{{ asset('assets_landing/images/chat.png') }}" alt="HJ. Abdul Khoir S.T" />
            </div>
            <div class="col-lg-6 mt-lg-0 mt-5 pt-lg-0 pt-4">
                <h3 class="fw-semibold lh-base mb-4">
                    Profil Singkat <br />
                    HJ. Abdul Khoir S.T <br />
                </h3>
                <h5 class="text-muted fw-normal">Dedikasi, Integritas, dan Kemajuan untuk Anda.</h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-4 border rounded mt-2">
                            <h5>Pendidikan Dasar & Menengah</h5>
                            <p class="text-muted">Dituntun oleh pendidikan yang berkualitas, mengukir dasar karakter yang kuat dan visioner.</p>
                        </div>
                        <div class="p-4 border rounded mt-2">
                            <h5>Pendidikan Tinggi</h5>
                            <p class="text-muted">Memperkuat fondasi pengetahuan dan kompetensi, berkontribusi untuk masyarakat yang lebih baik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- end feature -->

<!-- start services -->
<section class="section" id="service">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-12 mb-4">
                <h4 class="fw-semibold mb-3">Portofolio</h4>
                <h5 class="text-muted fw-normal">Don't you get what you want?</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mt-4 pt-2">
                <div class="service rounded px-4 py-md-5 py-3">
                    <div class="bg-info p-3 d-inline-block rounded-circle">
                        <i data-feather="users" class="text-white"></i>
                    </div>
                    <h6 class="my-4">Community</h6>
                    <p class="text-muted mb-4">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content. Moltin gives you the platform.
                    </p>

                </div>
            </div>
            <div class="col-md-4 mt-4 pt-2">
                <div class="service rounded px-4 py-md-5 py-3 active">
                    <div class="bg-warning p-3 d-inline-block rounded-circle">
                        <i data-feather="cast" class="text-white"></i>
                    </div>
                    <h6 class="my-4">Pre-approval</h6>
                    <p class="text-muted mb-4">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content. Moltin gives you the platform.
                    </p>

                </div>
            </div>
            <div class="col-md-4 mt-4 pt-2">
                <div class="service rounded px-4 py-md-5 py-3">
                    <div class="bg-danger p-3 d-inline-block rounded-circle">
                        <i data-feather="grid" class="text-white"></i>
                    </div>
                    <h6 class="my-4">Dashboard</h6>
                    <p class="text-muted mb-4">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content. Moltin gives you the platform.
                    </p>

                </div>
            </div>
            <div class="col-md-4 mt-4 pt-2">
                <div class="service rounded px-4 py-md-5 py-3">
                    <div class="bg-success p-3 d-inline-block rounded-circle">
                        <i data-feather="file" class="text-white"></i>
                    </div>
                    <h6 class="my-4">Reports</h6>
                    <p class="text-muted mb-4">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content. Moltin gives you the platform.
                    </p>

                </div>
            </div>
            <div class="col-md-4 mt-4 pt-2">
                <div class="service rounded px-4 py-md-5 py-3">
                    <div class="bg-secondary p-3 d-inline-block rounded-circle">
                        <i data-feather="droplet" class="text-white"></i>
                    </div>
                    <h6 class="my-4">Unlimited Colors</h6>
                    <p class="text-muted mb-4">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content. Moltin gives you the platform.
                    </p>

                </div>
            </div>
            <div class="col-md-4 mt-4 pt-2">
                <div class="service rounded px-4 py-md-5 py-3">
                    <div class="bg-dark p-3 d-inline-block rounded-circle">
                        <i data-feather="settings" class="text-white"></i>
                    </div>
                    <h6 class="my-4">Efficient</h6>
                    <p class="text-muted mb-4">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content. Moltin gives you the platform.
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- end servies -->

<!-- start faq -->
<section class="section border-top overflow-hidden" id="faq">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-12">
                <h6 class="text-muted mb-3">Visi dan Misi</h6>
                <h3 class="faq-title pb-4">HJ. Abdul Khoir S.T</h3>
                <div class="accordion accordion-flush mt-4 pt-2" id="accordionFlushExample">
                    <div class="accordion-item my-2">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button text-start text-dark fw-medium ps-0 pb-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Can we put a lot of effort in design?
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body text-muted pt-3">
                                High life accusamus terry richardson ad squid. 3 wolf moon
                                officia aute, non cupidatat skateboard dolor brunch. Food
                                truck quinoa nesciunt laborum eiusmod.It is a long
                                established fact that a reader will be distracted by the
                                readable.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item my-2">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button text-start text-dark fw-medium collapsed ps-0 pb-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                The most important of successful website?
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body text-muted pt-3">
                                Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                moon tempor, sunt aliqua put a bird on it squid
                                single-origin coffee nulla assumenda shoreditch et.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item my-2">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button text-start text-dark fw-medium collapsed ps-0 pb-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Submit Your Orgnization?
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body text-muted pt-3">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                accusamus terry richardson ad squid. 3 wolf moon officia
                                aute, non cupidatat skateboard dolor brunch.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item my-2">
                        <h2 class="accordion-header" id="flush-headingSix">
                            <button class="accordion-button text-start text-dark fw-medium collapsed ps-0 pb-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                New exhibition at our Museum?
                            </button>
                        </h2>
                        <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body text-muted pt-3">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                accusamus terry richardson ad squid. 3 wolf moon officia
                                aute, non cupidatat skateboard dolor brunch.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 offset-xl-1 col-lg-12">
                <img class="faq-img mt-sm-0 mt-5" src="{{ asset('assets_landing/images/faq.png') }}" alt="" />
            </div>
        </div>
    </div>
</section>
<!-- end faq -->

<!-- start testimonial -->
<section class="section" id="client">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-12 mb-4">
                <h4 class="fw-semibold mb-3">Guru</h4>
                <h5 class="text-muted fw-normal">Here From Our Members</h5>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-lg-12 mt-4 pt-2">
                <div class="testi-slider">
                    <div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="client-review">
                                    <div class="name position-relative">
                                        <img class="img-fluid" src="{{ asset('assets_landing/images/quotation.png') }}" alt="" />
                                        <h5 class="mt-4">Brians R. Evans</h5>
                                        <p class="text-muted">Freelance Software Engineer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-6 mt-5 pt-5">
                                    <div class="cli-text text-center text-muted">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing
                                            <br />
                                            elit. Suspendisse varius enim in eros elementum
                                            tristique. Duis cursus <br />
                                            mi quis viverra ornare, eros dolor interdum nulla, ut
                                            commodo dia <br />
                                            libero vitae erat. Aenean.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="client-review">
                                    <div class="name position-relative">
                                        <img class="img-fluid" src="{{ asset('assets_landing/images/quotation.png') }}" alt="" />
                                        <h5 class="mt-4">Emily B. Parham</h5>
                                        <p class="text-muted">Senior Web Designer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-6 mt-5 pt-5">
                                    <div class="cli-text text-center text-muted">
                                        <p>
                                            Sapien eget mi proin sed libero enim sed faucibus
                                            turpis <br />
                                            Viverra vitae congue eu consequat ac felis donec et.
                                            Tortor at auctor <br />
                                            urna nunc. Tempus iaculis urna id volutpat lacus
                                            laoreet <br />
                                            non eroe tempus cloitou.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="client-review">
                                    <div class="name position-relative">
                                        <img class="img-fluid" src="{{ asset('assets_landing/images/quotation.png') }}" alt="" />
                                        <h5 class="mt-4">Denver S. Taylor</h5>
                                        <p class="text-muted">Web Developer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-6 mt-5 pt-5">
                                    <div class="cli-text text-center text-muted">
                                        <p>
                                            Habitant morbi tristique senectus et netus et male
                                            <br />
                                            suada fames. Egestas pretium aenean pharetra magna ac
                                            placerat <br />
                                            lectus mauris. Ultrices neque ornare aenean euismod.
                                            Morbi tristi <br />
                                            senectus et netus et malesuada.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</div>
<!-- end-container -->
</section> -->
<!-- end brand logo -->
@endsection
