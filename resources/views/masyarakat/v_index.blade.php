<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>SPNF SKB SNN - Subang</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600;700&family=Montserrat:wght@200;400;600&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('landingpage/lib/animate/animate.min.css')}}" rel="stylesheet">
        <link href="{{ asset('landingpage/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
        <link href="{{ asset('landingpage/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('landingpage/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('landingpage/css/style.css')}}" rel="stylesheet">

        

    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid border-bottom bg-light wow fadeIn" data-wow-delay="0.1s">
            <div class="container topbar bg-primary d-none d-lg-block py-2" style="border-radius: 0 40px">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">Jl. Marsinu No.1, Dangdeur, Kec. Subang, Kabupaten Subang, Jawa Barat 41211
                        </a></small>
                    </div>
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light navbar-expand-xl py-3">
                    <a href="index.html" class="navbar-brand"><h1 class="text-primary display-6">SKB<span class="text-secondary">Subang</span></h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.html" class="nav-item nav-link active">Beranda</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pendaftaran</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="/formulirprogram" class="dropdown-item">Program SKB</a>
                                    <a href="/formulirpaud" class="dropdown-item">PAUD</a>
                                </div>
                            </div>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                            <a href="/login" class="nav-item nav-link">Login</a>
                        </div>
                        <div class="d-flex me-4">
                            <div id="phone-tada" class="d-flex align-items-center justify-content-center">
                                <a href="" class="position-relative wow tada" data-wow-delay=".9s" >
                                    <i class="fa fa-phone-alt text-primary fa-2x me-4"></i>
                                    <div class="position-absolute" style="top: -7px; left: 20px;">
                                        <span><i class="fa fa-comment-dots text-secondary"></i></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <button class="btn-search btn btn-primary btn-md-square rounded-circle" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-white"></i></button>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->

<!-- Hero Start -->
        <div class="container-fluid py-5 hero-header wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-7 col-md-12">
                    <h1 class="text-white mb-3">Sanggar Kegiatan Belajar</h1>
                    <p class="text-white mb-4">Selamat datang di website resmi SPNF SKB SNN Kabupaten Subang</p>
                    <br>
                    <a href="#tentang" class="btn btn-outline-light px-4 py-2">Profil SKB</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->

<!-- Service Start -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Ada apa sih di SKB?</h4>
            <h1 class="mb-5 display-3">Program Program di SKB Subang</h1>
        </div>

        <div class="container py-5">
            <div class="row g-4 text-center">
                <!-- Kartu Program -->
                <div class="col-md-4">
                    <div class="shadow p-4 bg-white rounded cursor-pointer" onclick="showModal('Program Kesetaraan', 'Program ini menyediakan pendidikan kesetaraan untuk warga belajar tingkat A, B, dan C.')">
                        <i class="fas fa-balance-scale fa-2x text-primary mb-3"></i>
                        <h5>Program Kesetaraan</h5>
                        <p>Lihat informasi mengenai Kesetaraan A, B, dan C</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="shadow p-4 bg-white rounded cursor-pointer" onclick="showModal('Pendidikan Anak Usia Dini', 'Program ini ditujukan untuk anak-anak usia dini sebagai pondasi pendidikan awal.')">
                        <i class="fas fa-child fa-2x text-primary mb-3"></i>
                        <h5>Pendidikan Anak Usia Dini</h5>
                        <p>Lihat informasi mengenai Pendidikan Anak Usia Dini</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="shadow p-4 bg-white rounded cursor-pointer" onclick="showModal('Program Pelatihan', 'Program pelatihan ini mencakup berbagai keterampilan seperti menjahit, komputer, dan lainnya.')">
                        <i class="fas fa-tools fa-2x text-primary mb-3"></i>
                        <h5>Program Pelatihan</h5>
                        <p>Lihat informasi mengenai Program Pelatihan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Modal Start -->
<div id="programModal" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-75 d-flex align-items-center justify-content-center" style="z-index: 9999; opacity: 0; pointer-events: none; transition: opacity 0.3s ease;">
    <div class="modal-box bg-white p-4 rounded shadow-lg position-relative" style="max-width: 500px; width: 90%; transform: scale(0.9); transition: transform 0.3s ease;">
        <button onclick="closeModal()" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Close"></button>
        <h4 id="modalTitle" class="mb-3"></h4>
        <p id="modalContent"></p>
    </div>
</div>
<!-- Modal End -->

<!-- JavaScript -->
<script>
    function showModal(title, content) {
        const modal = document.getElementById('programModal');
        const modalBox = modal.querySelector('.modal-box');
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalContent').innerText = content;

        modal.style.opacity = '1';
        modal.style.pointerEvents = 'auto';
        modalBox.style.transform = 'scale(1)';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('programModal');
        const modalBox = modal.querySelector('.modal-box');

        modal.style.opacity = '0';
        modal.style.pointerEvents = 'none';
        modalBox.style.transform = 'scale(0.9)';
        document.body.style.overflow = '';
    }
</script>


        <!-- About Start -->
        <div class="container-fluid py-5 about bg-light">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                        <div class="video border">
                            <button type="button" class="btn btn-play" data-bs-toggle="modal" data-src="https://youtu.be/Tfk5C9iRDmg?si=SmzCv1EOUNcPoGxf" data-bs-target="#videoModal">
                                <span></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-7 wow fadeIn" data-wow-delay="0.3s">
                        <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Tentang SKB</h4>
                        <h1 class="text-dark mb-4 display-5">We Learn Smart Way To Build Bright Futute For Our Generation</h1>
                        <p class="text-dark mb-4">SKB Kab. Subang (Sanggar Kegiatan Belajar Kabupaten Subang) adalah salah satu satuan pendidikan nonformal yang berada di bawah naungan Dinas Pendidikan Kabupaten Subang. SKB ini berperan penting dalam menyediakan layanan pendidikan untuk masyarakat yang tidak terlayani oleh pendidikan formal, dengan fokus pada pendidikan kesetaraan, pendidikan kecakapan hidup, PAUD, serta pelatihan keterampilan.
                        </p>
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <h6 class="mb-3"><i class="fas fa-check-circle me-2"></i>Lab Komputer</h6>
                                <h6 class="mb-3"><i class="fas fa-check-circle me-2 text-primary"></i>Ruang Menjahit</h6>
                                <h6 class="mb-3"><i class="fas fa-check-circle me-2 text-secondary"></i>Perpustakaan</h6>
                            </div>
                            <div class="col-lg-6">
                                <h6 class="mb-3"><i class="fas fa-check-circle me-2"></i>Ruang Belajar yang nyaman</h6>
                                <h6 class="mb-3"><i class="fas fa-check-circle me-2 text-primary"></i>Musola</h6>
                                <h6><i class="fas fa-check-circle me-2 text-secondary"></i>Taman bermain Anak Anak</h6>
                            </div>
                        </div>
                        <a href="" class="btn btn-primary px-5 py-3 btn-border-radius">Info Lebih Detail</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Video -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <<!-- Testimonial Start -->
<div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Testimoni Masyarakat</h4>
            <h1 class="mb-5 display-3">Apa Kata Mereka Tentang SKB?</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.3s">
            <!-- Testimoni 1 -->
            <div class="testimonial-item img-border-radius bg-light border border-primary p-4">
                <div class="p-4 position-relative">
                    <i class="fa fa-quote-right fa-2x text-primary position-absolute" style="top: 15px; right: 15px;"></i>
                    <div class="d-flex align-items-center">
                        <div class="border border-primary bg-white rounded-circle">
                            <img src="img/testimonial-1.jpg" class="rounded-circle p-2" style="width: 80px; height: 80px;" alt="Ibu Lina">
                        </div>
                        <div class="ms-4">
                            <h4 class="text-dark">Ibu Lina</h4>
                            <p class="m-0 pb-3">Warga Subang</p>
                            <div class="d-flex pe-5">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="border-top border-primary mt-4 pt-3">
                        <p class="mb-0">SKB sangat membantu saya untuk mendapatkan ijazah Paket C. Gurunya ramah dan pembelajarannya mudah dipahami. Terima kasih SKB!</p>
                    </div>
                </div>
            </div>
            <!-- Testimoni 2 -->
            <div class="testimonial-item img-border-radius bg-light border border-primary p-4">
                <div class="p-4 position-relative">
                    <i class="fa fa-quote-right fa-2x text-primary position-absolute" style="top: 15px; right: 15px;"></i>
                    <div class="d-flex align-items-center">
                        <div class="border border-primary bg-white rounded-circle">
                            <img src="img/testimonial-2.jpg" class="rounded-circle p-2" style="width: 80px; height: 80px;" alt="Pak Rudi">
                        </div>
                        <div class="ms-4">
                            <h4 class="text-dark">Pak Rudi</h4>
                            <p class="m-0 pb-3">Orang Tua Murid</p>
                            <div class="d-flex pe-5">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star-half-alt text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="border-top border-primary mt-4 pt-3">
                        <p class="mb-0">Anak saya sangat senang belajar di PAUD SKB. Fasilitas dan lingkungan belajarnya sangat mendukung perkembangan anak-anak.</p>
                    </div>
                </div>
            </div>
            <!-- Testimoni 3 -->
            <div class="testimonial-item img-border-radius bg-light border border-primary p-4">
                <div class="p-4 position-relative">
                    <i class="fa fa-quote-right fa-2x text-primary position-absolute" style="top: 15px; right: 15px;"></i>
                    <div class="d-flex align-items-center">
                        <div class="border border-primary bg-white rounded-circle">
                            <img src="img/testimonial-3.jpg" class="rounded-circle p-2" style="width: 80px; height: 80px;" alt="Siti Marlina">
                        </div>
                        <div class="ms-4">
                            <h4 class="text-dark">Siti Marlina</h4>
                            <p class="m-0 pb-3">Peserta Pelatihan</p>
                            <div class="d-flex pe-5">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="border-top border-primary mt-4 pt-3">
                        <p class="mb-0">Saya mengikuti pelatihan menjahit di SKB dan kini bisa buka usaha kecil di rumah. SKB benar-benar memberi saya keterampilan berharga.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->

        <!-- Footer Start -->
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="footer-item">
                            <h2 class="fw-bold mb-3"><span class="text-primary mb-0">Baby</span><span class="text-secondary">Care</span></h2>
                            <p class="mb-4">There cursus massa at urnaaculis estieSed aliquamellus vitae ultrs condmentum leo massamollis its estiegittis miristum.</p>
                            <div class="border border-primary p-3 rounded bg-light">
                                <h5 class="mb-3">Newsletter</h5>
                                <div class="position-relative mx-auto border border-primary rounded" style="max-width: 400px;">
                                    <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2 text-white">SignUp</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="footer-item">
                            <div class="d-flex flex-column p-4 ps-5 text-dark border border-primary" 
                            style="border-radius: 50% 20% / 10% 40%;">
                                <p>Monday: 8am to 5pm</p>
                                <p>Tuesday: 8am to 5pm</p>
                                <p>Wednes: 8am to 5pm</p>
                                <p>Thursday: 8am to 5pm</p>
                                <p>Friday: 8am to 5pm</p>
                                <p>Saturday: 8am to 5pm</p>
                                <p class="mb-0">Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="footer-item">
                            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">LOCATION</h4>
                            <div class="d-flex flex-column align-items-start">
                                <a href="" class="text-body mb-4"><i class="fa fa-map-marker-alt text-primary me-2"></i> 104 North tower New York, USA</a>
                                <a href="" class="text-start rounded-0 text-body mb-4"><i class="fa fa-phone-alt text-primary me-2"></i> (+012) 3456 7890 123</a>
                                <a href="" class="text-start rounded-0 text-body mb-4"><i class="fas fa-envelope text-primary me-2"></i> exampleemail@gmail.com</a>
                                <a href="" class="text-start rounded-0 text-body mb-4"><i class="fa fa-clock text-primary me-2"></i> 26/7 Hours Service</a>
                                <div class="footer-icon d-flex">
                                    <a class="btn btn-primary btn-sm-square me-3 rounded-circle text-white" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-primary btn-sm-square me-3 rounded-circle text-white" href=""><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm-square me-3 rounded-circle text-white"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm-square rounded-circle text-white"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="footer-item">
                            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">OUR GALLARY</h4>
                            <div class="row g-3">
                                <div class="col-4">
                                    <div class="footer-galary-img rounded-circle border border-primary">
                                        <img src="img/galary-1.jpg" class="img-fluid rounded-circle p-2" alt="">
                                    </div>
                               </div>
                               <div class="col-4">
                                    <div class="footer-galary-img rounded-circle border border-primary">
                                        <img src="img/galary-2.jpg" class="img-fluid rounded-circle p-2" alt="">
                                    </div>
                               </div>
                                <div class="col-4">
                                    <div class="footer-galary-img rounded-circle border border-primary">
                                        <img src="img/galary-3.jpg" class="img-fluid rounded-circle p-2" alt="">
                                    </div>
                               </div>
                                <div class="col-4">
                                    <div class="footer-galary-img rounded-circle border border-primary">
                                        <img src="img/galary-4.jpg" class="img-fluid rounded-circle p-2" alt="">
                                    </div>
                               </div>
                                <div class="col-4">
                                    <div class="footer-galary-img rounded-circle border border-primary">
                                        <img src="img/galary-5.jpg" class="img-fluid rounded-circle p-2" alt="">
                                    </div>
                               </div>
                                <div class="col-4">
                                    <div class="footer-galary-img rounded-circle border border-primary">
                                        <img src="img/galary-6.jpg" class="img-fluid rounded-circle p-2" alt="">
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a clas="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landingpage/lib/wow/wow.min.js')}}"></script>
    <script src="{{ asset('landingpage/lib/easing/easing.min.js')}}"></script>
    <script src="{{ asset('landingpage/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ asset('landingpage/lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{ asset('landingpage/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('landingpage/js/main.js')}}"></script>
    </body>

</html>