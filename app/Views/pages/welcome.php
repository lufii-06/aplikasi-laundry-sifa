<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dita Laundry || Website</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?php echo base_url() ?>LandingPageAssets/assets/img/images.jpeg" rel="icon">
    <link href="<?php echo base_url() ?>LandingPageAssets/assets/img/images.jpeg" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url() ?>LandingPageAssets/assets/vendor/bootstrap/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="<?php echo base_url() ?>LandingPageAssets/assets/vendor/bootstrap-icons/bootstrap-icons.css"
        rel="stylesheet">
    <link href="<?php echo base_url() ?>LandingPageAssets/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>LandingPageAssets/assets/vendor/glightbox/css/glightbox.min.css"
        rel="stylesheet">
    <link href="<?php echo base_url() ?>LandingPageAssets/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?php echo base_url() ?>LandingPageAssets/assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: eNno
  * Template URL: https://bootstrapmade.com/enno-free-simple-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="/" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">Dita Laundry</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#services">Jenis Layanan</a></li>
                    <li><a href="#call-to-action">Cek Estimasi Cucian</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <?php if (session()->get('isLoggedIn')): ?>
            <a class="btn-getstarted" href="/home">Admin Page</a>
            <?php else: ?>
            <a class="btn-getstarted" href="/login">Login</a>
            <?php endif; ?>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"
                        data-aos="fade-up">
                        <h1>Bersihnya Nyata, Pelayanannya Terasa</h1>
                        <h4>Kami melayani dengan sepenuh hati dan teknologi terkini</h3>
                            <div class="d-flex">
                                <a href="#about" class="btn-get-started">Periksa Cucian</a>
                            </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-5 hero-img" data-aos="zoom-out" data-aos-delay="100">
                        <img src="<?php echo base_url() ?>LandingPageAssets/assets/img/bp1.jpeg"
                            class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Featured Services Section -->
        <!-- <section id="featured-services" class="featured-services section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <img src="<?php echo base_url() ?>LandingPageAssets/assets/img/bp2.jpeg"
                                class="img-fluid animated" alt="">
                            <p>
                            <h4><a href="" class="stretched-link">SETRIKA</a></h4>
                            <p>Memberikan hasil setrika yang rapi dan wangi, mencerminkan perhatian pada detail dan
                                profesionalisme layanan.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <img src="<?php echo base_url() ?>LandingPageAssets/assets/img/bp3.png"
                                class="img-fluid animated" alt="">
                            <h4><a href="" class="stretched-link">PAKAIAN</a></h4>
                            <p>Merawat setiap pakaian pelanggan dengan hati-hati, seolah milik sendiri, untuk menjaga
                                kualitas dan kenyamanan pakaian.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <img src="<?php echo base_url() ?>LandingPageAssets/assets/img/bp4.png"
                                class="img-fluid animated" alt="">
                            <h4><a href="" class="stretched-link">CUCI</a></h4>
                            <p>Menjaga kebersihan dan kesegaran pakaian pelanggan melalui proses pencucian yang higienis
                                dan ramah lingkungan.</p>
                        </div>
                    </div>

                </div>

            </div>

        </section> -->
        <!-- /Featured Services Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Dita Laundry <br></span>
                <h2>Tentang Dita Laundry
                </h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                        <img src="<?php echo base_url() ?>LandingPageAssets/assets/img/bp5.png" class="img-fluid"
                            alt="">

                    </div>
                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">

                        <p class="font-bold">
                            Dita Laundry adalah layanan laundry profesional yang berlokasi di [isi lokasi], berdiri
                            sejak tahun [tahun berdiri], dan melayani kebutuhan cuci pakaian harian maupun kiloan dengan
                            harga terjangkau dan hasil yang bersih, wangi, serta rapi.
                        </p>
                        <p>Kami melayani:</p>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> <span>Layanan cuci kiloan, satuan dan express.</span>
                            </li>
                            <li><i class="bi bi-check2-all"></i> <span>Cuci Bed Cover, Sprei, Boneka</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Cuci Kering dan Setrika</span></li>
                        </ul>
                        <p>
                            Dengan tenaga kerja yang berpengalaman dan penggunaan deterjen serta pelembut pilihan, Dita
                            Laundry selalu mengutamakan kepuasan pelanggan.
                        </p>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>JENIS LAYANAN</span>
                <h2>JENIS LAYANAN</h2>

            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    <?php foreach ($datas as $data): ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi-bag-check" style="font-size: 32px;"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3><?php echo $data->nama_cucian ?></h3>
                            </a>
                            <p><?php echo $data->nama_layanan ?>
                            </p>
                        </div>
                    </div><!-- End Service Item -->
                    <?php endforeach; ?>
                </div>

            </div>

        </section><!-- /Services Section -->



        <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section accent-background">

            <div class="container">
                <div class="row" data-aos="zoom-in" data-aos-delay="100">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h3>Cek Status Cucian</h3>
                        <form id="form-cari" action="/cetak-laporan-transaksi-perid" method="post" target="_blank">
                            <div class="mb-3">
                                <label for="id" class="form-label">ID Faktur</label>
                                <input type="text" class="form-control" id="id" name="id"
                                    placeholder="Masukkan ID Faktur">
                            </div>
                            <div class="mb-3">
                                <label for="nohp" class="form-label">Nohp</label>
                                <input type="text" class="form-control" id="nohp" name="nohp"
                                    placeholder="Masukkan Nohp">
                            </div>
                            <div class="d-flex w-100 justify-content-center">
                                <a class="cta-btn "
                                    onclick="document.querySelector('#form-cari').submit(); return false;">Cek status
                                    cucian</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8">
                        <div class="text-center">
                            <h3>Dita Laundry - Bersihnya Nyata, Pelayanannya Terasa.</h3>
                            <p>Kami hadir untuk memberikan solusi terbaik bagi Anda yang ingin hasil laundry bersih,
                                wangi, dan rapi tanpa repot. Dengan layanan cuci kiloan, satuan, hingga express 1 hari,
                                serta fasilitas antar-jemput gratis, kami mengutamakan kenyamanan dan kepuasan
                                pelanggan. Dita Laundry didukung oleh teknologi modern dan tim profesional yang
                                berkomitmen untuk memberikan pelayanan terbaik di setiap proses. Percayakan pakaian Anda
                                kepada kami, dan rasakan perbedaannya!</p>
                            <a class="cta-btn" href="#contact">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Call To Action Section -->



        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Hubungi Kami</span>
                <h2>Kontak</h2>
                <p>Jika ingin informasi lebih lanjut hubungi kami sekarang juga</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-5">

                        <div class="info-wrap">
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h3>Address</h3>
                                    <p>jl.malintang no.68 cupak tangah, kec. pauh, kota padang, sumatera barat
                                    </p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                    <h3>Call Us</h3>
                                    <p>081267886585</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>Email Us</h3>
                                    <p>ditalaundry@gmail.com</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>
                    </div>

                    <div class="col-lg-7">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15938.168282039407!2d100.3599306!3d-0.9492437!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b92987e9eeb3%3A0x3039d80b220cc90!2sPadang%2C%20Kota%20Padang%2C%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1691394870871!5m2!1sid!2sid"
                            frameborder="0" style="border:0; width: 100%; height: 100%;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="/" class="d-flex align-items-center">
                        <span class="sitename">Dita Laundry</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>jl.malintang no.68 cupak tangah, kec. pauh, <br> kota padang, sumatera barat
                        </p>
                        <p class="mt-3"><strong>Phone:</strong> <span>081267886585 </span></p>
                        <p><strong>Email:</strong> <span>ditalaundry@gmail.com</span></p>
                        <p><strong>Jam operasional:</strong> <span>08.00 - 22.00</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#about">Tentang Kami</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#services">Jenis Layanan</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#call-to-action">Cek Estimasi Cucian</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#contact">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <?php foreach (array_slice($datas, 0, 5) as $data): ?>
                        <li><i class="bi bi-chevron-right"></i> <a href="#services"><?php echo $data->nama_cucian ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Ikuti media sosial kami untuk mendapatkan promo terbaru, tips perawatan pakaian, dan info layanan
                        Dita Laundry.</p>
                    <div class="social-links d-flex">
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Dita Laundry</strong> <span>All Rights
                    Reserved</span></p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?php echo base_url() ?>LandingPageAssets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js">
    </script>
    <script src="<?php echo base_url() ?>LandingPageAssets/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?php echo base_url() ?>LandingPageAssets/assets/vendor/aos/aos.js"></script>
    <script src="<?php echo base_url() ?>LandingPageAssets/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?php echo base_url() ?>LandingPageAssets/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?php echo base_url() ?>LandingPageAssets/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js">
    </script>
    <script src="<?php echo base_url() ?>LandingPageAssets/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url() ?>LandingPageAssets/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="<?php echo base_url() ?>LandingPageAssets/assets/js/main.js"></script>

</body>

</html>