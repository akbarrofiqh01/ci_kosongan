<!DOCTYPE html>
<html lang="ID">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="icon" href="<?php echo base_url('assets/images/favicon2.png') ?>" sizes="32x32" type="image/png">
    <title>SISPENJU</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/icons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/animate.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/fancybox.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/jquery.circliful.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/responsive.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/colors/color3.css') ?>">
</head>

<body>
    <main>
        <style>
            .walink {
                z-index: 99999;
                padding: 15px;
                padding-left: 5px;
                bottom: 35px;
                position: fixed;
                right: 0;
            }

            .bg-wa {
                position: absolute;
                width: 200px;
                right: 100%;
                background-color: #22d466;
                font-size: 14px;
                color: #000;
                padding: 7px 7px 7px 12px;
                letter-spacing: -0.03em;
                border-radius: 4px;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                transition: .2s;
                -webkit-transition: 0.4s ease all;
                -moz-transition: 0.4s ease all;
            }
        </style>
        <a href="whatsapp://send?text=Assalamualaikum.. Yth. Admin SISPENJU, mohon informasi cara mendaftar menjadi Agen atau Calon Jamaah Umroh melalui aplikasi SISPENJU 🙏
&phone=+6281919181849" rel="noopener nofollow" title="Hubungi Pendaftaran Jamaah Umroh" class="walink">
            <div class="bg-wa">
                "Daftar Umroh Dapatkan Berkahnya"
                <br><strong style="font-weight: bold;">Ayo Chat Sekarang Juga</strong>
            </div>
            <img src="<?php echo base_url('assets/whatsapp.svg') ?>" alt="Hubungi via WhatsApp" title="Hubungi via WhatsApp" style="max-width: 60px;width:60px;height:60px border-radius:50%">
        </a>
        <!-- <div class="pageloader-wrap">
            <div class="loader">
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__bar"></div>
                <div class="loader__ball"></div>
            </div>
        </div>Pageloader Wrap -->
        <header class="style2">
            <div class="container">
                <div class="logo">
                    <a href="<?php echo site_url('') ?>" title="Logo">
                        <img src="<?php echo base_url('assets/logo-green-new.png') ?>" alt="Sispenju" style="max-width: 250px;">
                    </a>
                </div>
                <nav>
                    <div>
                        <a class="srch-btn" href="#" title=""><i class="fa fa-search"></i></a>
                        <a class="thm-btn brd-rd5" href="<?php echo site_url('login') ?>" title="">Member Area</a>
                        <ul>
                            <li class=""><a href="#home" title="">Beranda</a></li>
                            <li class=""><a href="#galeri" title="">Galeri</a></li>
                            <li><a href="#kontak" title="">Kontak</a></li>
                            <li><a href="#tentangkami" title="">Tentang Kami</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header><!-- Header -->
        <div class="rspn-hdr">
            <div class="lg-mn">
                <div class="logo">
                    <a href="<?php echo site_url('') ?>" title="Logo">
                        <img src="<?php echo base_url('assets/logo-green-new.png') ?>" alt="Sispenju" style="max-width: 180px;">
                    </a>
                </div>
                <div class="rspn-cnt">
                    <span><i class="fa fa-envelope thm-clr"></i><a href="#" title=""></a></span>
                    <span><i class="fa fa-phone thm-clr"></i></span>
                </div>
                <span class="rspn-mnu-btn"><i class="fa fa-list-ul"></i></span>
            </div>
            <div class="rsnp-mnu">
                <span class="rspn-mnu-cls"><i class="fa fa-times"></i></span>
                <ul>
                    <li class=""><a href="#home" title="">beranda</a>
                    </li>
                    <li class=""><a href="#galeri" title="">Galeri</a>
                    </li>
                    <li class=""><a href="#kontak" title="">Kontak</a></li>
                    <li class=""><a href="#tentangkami" title="">Tentang Kami</a></li>
                </ul>
                <a class="btn thm-btn brd-rd5" href="<?php echo site_url('login') ?>" title="">Member Area</a>
            </div><!-- Responsive Menu -->
        </div><!-- Responsive Header -->
        <div class="header-search">
            <span class="srch-cls-btn brd-rd5"><i class="fa fa-times"></i></span>
            <form>
                <input type="text" placeholder="Search here...">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div><!-- Header Search -->
        <div class="contact-form-model-wrap text-center">
            <span class="model-close"><i class="fa fa-times"></i></span>
            <div class="contact-form-inner">
                <div class="sec-title text-center">
                    <div class="sec-title-inner">
                        <span>Have Question</span>
                        <h3>Send Message</h3>
                    </div>
                </div>
                <div class="contact-form text-center">
                    <form>
                        <div class="row mrg20">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <input type="text" placeholder="Name">
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <input type="text" placeholder="Phone">
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <input type="email" placeholder="Email">
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <input type="text" placeholder="Subject">
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <textarea placeholder="Message"></textarea>
                                <button class="thm-btn brd-rd40" type="submit">Contact Us</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- Contact Form Model Wrap -->
        <section class="owl-curve-green">
            <div class="gap no-gap">
                <div class="featured-area-wrap text-center">
                    <div class="featured-area2 owl-carousel">
                        <div class="featured-item style2" style="background-image:url(<?php echo base_url('assets/frontend/images/Galeri/manasik-umroh-10.jpg') ?>);">
                            <div class="featured-cap">
                                <h4 style="color:white;">APLIKASI TERPERCAYA
                                    UNTUK WUJUDKAN NIAT
                                    KE TANAH SUCI</h4>
                                <span>"DAFTAR UMROH DAPATKAN BERKAHNYA"</span>
                            </div>
                        </div>
                        <div class="featured-item style2" style="background-image:url(<?php echo base_url('assets/frontend/images/Galeri/pemberangkatan-umroh-3.jpg') ?>);">
                            <div class="featured-cap">
                                <h4 style="color:white;">APLIKASI TERPERCAYA
                                    UNTUK WUJUDKAN NIAT
                                    KE TANAH SUCI</h4>
                                <span>"DAFTAR UMROH DAPATKAN BERKAHNYA"</span>
                            </div>
                        </div>
                        <div class="featured-item style2" style="background-image:url(<?php echo base_url('assets/frontend/images/Galeri/pemberangkatan-umroh-2.jpg') ?>);">
                            <div class="featured-cap">
                                <h4 style="color:white;">APLIKASI TERPERCAYA
                                    UNTUK WUJUDKAN NIAT
                                    KE TANAH SUCI</h4>
                                <span>"DAFTAR UMROH DAPATKAN BERKAHNYA"</span>
                            </div>
                        </div>
                        <div class="featured-item style2" style="background-image:url(<?php echo base_url('assets/frontend/images/Galeri/pemberangkatan-umroh.jpg') ?>);">
                            <div class="featured-cap">
                                <h4 style="color:white;">APLIKASI TERPERCAYA
                                    UNTUK WUJUDKAN NIAT
                                    KE TANAH SUCI</h4>
                                <span>"DAFTAR UMROH DAPATKAN BERKAHNYA"</span>
                            </div>
                        </div>
                    </div>
                </div><!-- Featured Area Wrap -->
            </div>
        </section>

        <section id="home">
            <div class="gap">
                <div class="container">
                    <div class="sec-title style2 text-center">
                        <div class="sec-title-inner">
                            <h3>Beranda</h3>
                        </div>
                    </div>
                    <div class="hstry-wrap">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-lg-6">
                                <div class="text-center">
                                    <img src="<?php echo base_url('assets/logo-kakbah-green.png') ?>" alt="hstry-img.png" style="max-width: 250px;">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-lg-6">
                                <div class="hstry-desc">
                                    <h3 style="text-align: center; color:green;">SISTEM PENDAFTARAN JAMA'AH UMROH</h3>
                                    <p>
                                    <h4>Apa Itu Sispenju ?</h4>
                                    </p>
                                    <p><b>SISPENJU</b> adalah aplikasi berbasis web yang dirancang untuk menangani proses pendaftaran, pembayaran dan pelunasan biaya perjalanan ibadah umroh beserta data terkait lainnya, sehingga dari seluruh proses kegiatan pendaftaran, pembayaran dan pelunasan tersebut, dapat dihasilkan informasi yang berguna untuk pengambilan keputusan, pembayaran komisi (ujroh) kepada agen, maupun pelaporan kegiatan penyelenggaraan perjalanan baik perjalanan ibadah umroh maupun perjalanan wisata lainnya</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-lg-6 mt-3">
                                <div class="hstry-desc">
                                    <p>
                                    <h4>Kenapa Sispenju ?</h4>
                                    </p>
                                    <p>Dengan <b>SISPENJU</b> para agen marketing umroh dapat secara mudah mendaftarkan calon jamaahnya dan langsung menikmati komisi (ujroh) yang menjadi haknya, secara cepat, adil dan transparan</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-lg-6">
                                <div class="hstry-desc">
                                    <p>
                                    <h3 style="text-align: center; color:green;">Bosan Di PHP Terus ?</h3>
                                    <p>
                                    <h4>SISPENJU Solusinya</h4>
                                    </p>
                                    </p>
                                    <p><b>Fakta di lapangan !!</b> Banyak agen mengeluhkan, sering diberi janji-janji manis jika bisa menyumbang jamaah. Kenyataannya setelah jamaahnya berangkat, berhari-hari bahkan berbulan-bulan hanya di PHP belaka. Kini berkat <b>SISPENJU</b> semua janji bisa menjadi nyata, komisi dan hak agen langsung dibayarkan meskipun jamaahnya masih proses diberangkatkan</p>
                                </div>
                            </div>
                        </div><!-- History Wrap -->
                    </div>
                </div>
        </section>
        <section>
            <div class="sec-title style2 text-center">
                <div class="sec-title-inner">
                    <h3>Tahapan SISPENJU</h3>
                </div>
            </div>
            <div class="container mt-5 mb-5 padding:10px;">
                <div class="card" id="accordion">
                    <div class="card-header" style="background-color:#E1E1E1;" id="headingOne">
                        <h3 class="mb-1 mt-1">
                            <button class="btn btn-link" style="color: black;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <h4 style="text-align:left;">1. Pembayaran Porsi Umroh</h4>
                            </button>
                        </h3>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body" style="text-align: center;">
                            Untuk bisa didaftarkan ke SISPENJU, jamaah terlebih dahulu harus melakukan pembayaran porsi umroh (DP) sebesar Rp 3.000.000. Dengan begitu, jamaah sudah berhak untuk mendapatkan seperangkat koper berserta perlengkapan umroh dan pembuatan paspor bagi yang belum memilikinya. Koper bisa dijemput ke Kantor Cabang atau ke Kantor Perwakilan, atau dikirim ke alamat melalui ekspedisi dengan ongkir ditanggung oleh jamaah. Untuk paspor, biaya pembuatan (setoran PNBP) hanya diberikan untuk jamaah yang sama sekali belum memiliki paspor atau jamaah yang memiliki paspor namun sudah mendekati masa berakhir paspor (minimal 6 bulan sebelum kadaluarsa)
                        </div>
                    </div>
                    <div class="card-header" style="background-color:#E1E1E1;" id="headingTwo">
                        <h5 class="mb-1 mt-1">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h4 style="text-align:left;">2. Pembayaran Booking Seat</h4>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body" style="text-align: center;">
                            Setelah pembayaran porsi umroh, jamaah bisa melanjutkan ke tahap pelunasan atau minimal pembayaran booking seat sebesar Rp 7.000.000, untuk bisa memastikan jadwal keberangkatan ke tanah suci
                        </div>
                    </div>
                    <div class="card-header" style="background-color:#E1E1E1;" id="headingThree">
                        <h5 class="mb-1">
                            <button class="btn btn-link collapsed" style="color: black;" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <h4 style="text-align:left;">3. Pelunasan
                                </h4>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" style="color: black;" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body" style="text-align: center;">
                            Pelunasan atas sisa biaya perjalanan ibadah umroh, dapat dilakukan bersamaan dengan pembayaran booking seat, atau pun terpisah dengan ketentuan paling lambat 30 hari sebelum tanggal keberangkatan
                        </div>
                    </div>
                    <div class="card-header" style="background-color:#E1E1E1;" id="headingFour">
                        <h5 class="mb-1" style="text-align:left;">
                            <button class="btn btn-link collapsed" style="color: black;" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <h4 style="text-align:left;">4. Pemberangkatan
                                </h4>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" style="color: black;" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body" style="text-align: center;">
                            Pemberangkatan jamaah sesuai dengan paket dan tanggal yang telah dijadwalkan. Jamaah diberangkatkan melalui travel pilihan yang telah menjalin kerjasama dengan pihak perusahaan, dalam hal ini dengan PT. SISPENJU AMANAH DIGITAL
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="gap">
                <div class="container">
                    <div class="sec-title style2 text-center">
                        <div class="sec-title-inner">
                            <h3>Komisi Agen SISPENJU</h3>
                        </div>
                    </div>
                    <p style="font-size: 20px; color:black;">Setiap agen yang berhasil mendaftarkan agen atau jamaahnya melalui aplikasi <b>SISPENJU</b>, berhak atas komisi (ujroh) mulai dari Rp 1.500.000 per jamaah hingga Rp 3.000.000 per jamaah, yang terdiri dari :</p>
                    <div class="serv-wrap text-center remove-ext3">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-lg-3">
                                <div class="srv-box2">
                                    <i class="flaticon-quran-rehal"></i>
                                    <div class="srv-info2 mb-4">
                                        <h4>Komisi Pendaftaran Agen/Jamaah</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-lg-3">
                                <div class="srv-box2">
                                    <i class="flaticon-heart-1"></i>
                                    <div class="srv-info2 mb-4">
                                        <h4>Komisi Pembinaan Team</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-lg-3">
                                <div class="srv-box2">
                                    <i class="fa fa-money mb-4"></i>
                                    <div class="srv-info2 mb-3">
                                        <h4>Komisi Booking Seat/Pelunasan</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-lg-3">
                                <div class="srv-box2 mb-2">
                                    <i class="flaticon-social-care"></i>
                                    <div class="srv-info2 mb-5">
                                        <h4>Point Reward</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="galeri">
            <div class="gap">
                <div class="container">
                    <div class="sec-title style2 text-center">
                        <div class="sec-title-inner">
                            <h3>Galeri</h3>
                        </div>
                    </div>
                    <div class="prtfl-wrap text-center">
                        <ul class="fltr-lnks">
                            <li class="active"><a data-filter="*" href="#">Semua</a></li>
                            <li><a data-filter=".fltr-itm1" href="#">Manasik Umroh</a></li>
                            <li><a data-filter=".fltr-itm2" href="#">Pemberangkatan Umroh Tgl 4 Oktober</a></li>
                            <li><a data-filter=".fltr-itm3" href="#">Pemberangkatan Umroh Tgl 14 November</a></li>
                            <li><a data-filter=".fltr-itm4" href="#">Video</a></li>
                        </ul>
                        <div class="prtfl-dta remove-ext1">
                            <div class="row mrg15 masonry">
                                <div class="col-md-4 col-sm-6 col-lg-4 fltr-itm fltr-itm1">
                                    <div class="prtfl-box">
                                        <img src="<?php echo base_url('assets/frontend/images/Galeri/manasik-umroh-11.jpg') ?>" alt="manasik-umroh-11.jpg">
                                        <div class="prtfl-info">
                                            <a href="<?php echo base_url('assets/frontend/images/Galeri/manasik-umroh-11.jpg') ?>" data-fancybox="gallery" title=""><i class="fa fa-plus"></i></a>
                                            <h4></h4>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="prtfl-box">
                                        <img src="<?php echo base_url('assets/frontend/images/Galeri/manasik-umroh-5.jpg') ?>" alt="manasik-umroh-5.jpg">
                                        <div class="prtfl-info">
                                            <a href="<?php echo base_url('assets/frontend/images/Galeri/manasik-umroh-5.jpg') ?>" data-fancybox="gallery" title=""><i class="fa fa-plus"></i></a>
                                            <h4></h4>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-lg-4 fltr-itm fltr-itm3">
                                    <div class="prtfl-box">
                                        <img src="<?php echo base_url('assets/frontend/images/Galeri/umrooh-tgl-14-1.jpg') ?>" alt="umrooh-tgl-14-1.jpg">
                                        <div class="prtfl-info">
                                            <a href="<?php echo base_url('assets/frontend/images/Galeri/umrooh-tgl-14-1.jpg') ?>" data-fancybox="gallery" title=""><i class="fa fa-plus"></i></a>
                                            <h4></h4>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="prtfl-box">
                                        <img src="<?php echo base_url('assets/frontend/images/Galeri/umroh-tgl-14-2.jpg') ?>" alt="umroh-tgl-14-2.jpg">
                                        <div class="prtfl-info">
                                            <a href="<?php echo base_url('assets/frontend/images/Galeri/umroh-tgl-14-2.jpg') ?>" data-fancybox="gallery" title=""><i class="fa fa-plus"></i></a>
                                            <h4></h4>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-lg-4 fltr-itm fltr-itm2">
                                    <div class="prtfl-box">
                                        <img src="<?php echo base_url('assets/frontend/images/Galeri/umroh-tgl-4-1.jpg') ?>" alt="prtfl-img6.jpg">
                                        <div class="prtfl-info">
                                            <a href="<?php echo base_url('assets/frontend/images/Galeri/umroh-tgl-4-1.jpg') ?>" data-fancybox="gallery" title=""><i class="fa fa-plus"></i></a>
                                            <h4></h4>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="prtfl-box">
                                        <img src="<?php echo base_url('assets/frontend/images/Galeri/umroh-tgl-4-3.jpg') ?>" alt="umroh-tgl-4-3.jpg">
                                        <div class="prtfl-info">
                                            <a href="<?php echo base_url('assets/frontend/images/Galeri/umroh-tgl-4-3.jpg') ?>" data-fancybox="gallery" title=""><i class="fa fa-plus"></i></a>
                                            <h4></h4>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6 fltr-itm fltr-itm1 ">
                                    <div class="prtfl-box">
                                        <img src="<?php echo base_url('assets/frontend/images/Galeri/manasik-umroh-10.jpg') ?>" alt="manasik-umroh-10.jpg">
                                        <div class="prtfl-info">
                                            <a href="<?php echo base_url('assets/frontend/images/Galeri/manasik-umroh-10.jpg') ?>" data-fancybox="gallery" title=""><i class="fa fa-plus"></i></a>
                                            <h4></h4>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6 fltr-itm fltr-itm3 ">
                                    <div class="prtfl-box">
                                        <img src="<?php echo base_url('assets/frontend/images/Galeri/umroh-tgl-14-3.jpg') ?>" alt="umroh-tgl-14-3.jpg">
                                        <div class="prtfl-info">
                                            <a href="<?php echo base_url('assets/frontend/images/Galeri/umroh-tgl-14-3.jpg') ?>" data-fancybox="gallery" title=""><i class="fa fa-plus"></i></a>
                                            <h4></h4>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6 fltr-itm fltr-itm2 ">
                                    <div class="prtfl-box">
                                        <img src="<?php echo base_url('assets/frontend/images/Galeri/umroh-tgl-4-2.jpg') ?>" alt="umroh-tgl-4-2.jpg">
                                        <div class="prtfl-info">
                                            <a href="<?php echo base_url('assets/frontend/images/Galeri/umroh-tgl-4-2.jpg') ?>" data-fancybox="gallery" title=""><i class="fa fa-plus"></i></a>
                                            <h4></h4>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6 fltr-itm fltr-itm4">
                                    <video width="300" height="300" controls>
                                        <source src="<?php echo base_url('assets/frontend/images/Galeri/vidio-1.mp4') ?>" type="video/mp4">
                                        <source src="movie.ogg" type="video/ogg">
                                    </video>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6 fltr-itm fltr-itm4 ">
                                    <video width="300" height="300" controls>
                                        <source src="<?php echo base_url('assets/frontend/images/Galeri/vidio-2.mp4') ?>" type="video/mp4">
                                        <source src="movie.ogg" type="video/ogg">
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="kontak">
            <div class="gap">
                <div class="container">
                    <div class="sec-title style2 text-center">
                        <div class="sec-title-inner">
                            <h3>Kontak</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="contact-form text-center">
                                <form>
                                    <div class="row mrg20">
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <textarea placeholder="Deskripsi" id="pesan"></textarea>
                                            <a onclick="kirim_pesan()"><button class="thm-btn brd-rd40 mt-2" type="submit">Kirim Pesan</button></a>
                                        </div>
                                        <script>
                                            function kirim_pesan() {
                                                var pesan = $('#pesan').val();
                                                location.href = "whatsapp://send?text=" + pesan + "&phone=+6281919181849"
                                            }
                                        </script>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6 mt-1 text-center">
                            <h6>
                                <h5 style="color:green;">PT. SISPENJU AMANAH DIGITAL</h5>
                                <p> <b>Head Office : Jl. Gajah Mada No. 302 RT. 53 Jelutung, Kota Jambi 36136
                                        Cutomer Service : 081919181849 (Whatsapp)</b></p>
                            </h6>

                            <h6>

                                DAFTAR TRAVEL YANG TELAH BEKERJASAMA DENGAN <br> PT. SISPENJU AMANAH DIGITAL :
                            </h6>
                            <p><b>PT. SAUDI ISLAMIC TOUR <br> PPIU No. 10062200283780007 TAHUN 2022
                                    <br>PT. RIZQUNA HIKMAH SEJAHTERA <br> PPIU No. U.112 TAHUN 2020</br>
                            </p>

                        </div>
                    </div><!-- Events & Prayer Wrap -->
                </div>
            </div>
        </section>
        <section id="tentangkami">
            <div class="gap">
                <div class="container">
                    <div class="srv-wrap3">
                        <div class="sec-title style2 text-center">
                            <div class="sec-title style2 text-center">
                                <div class="sec-title-inner">
                                    <h3>Tentang Kami</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div class="remove-ext5">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="srv-box3">
                                                <p><b>PT. SISPENJU AMANAH DIGITAL</b> adalah perusahaan yang bergerak di bidang pemasaran paket perjalanan wisata khususnya perjalanan ibadah haji dan umroh, serta wisata muslim lainnya.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="srv-box3">
                                                <p>Melalui platform (aplikasi) yang kami miliki, diharapkan bisa membuka kesempatan berusaha seluas mungkin bagi masyarakat yang ingin berkecimpung di bidang tour & travel khususnya haji dan umroh, tanpa harus mengeluarkan modal atau biaya yang besar.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="srv-box3">
                                                <p>Didukung oleh tenaga pemasaran dan tenaga IT yang profesional serta berpengalaman, saat ini perusahaan telah menjalin kerjasama dengan berbagai perusahaan tour & travel ternama yang tentu saja berizin resmi, dalam pemberangkatan jamaah haji maupun umroh.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="srv-box3">
                                                <p>Dengan platform tersebut, dimungkinkan terciptanya sistem pembayaran komisi agen (ujroh) yang cepat, adil dan transparan.</p>
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
        <footer>
            <div class="gap top-spac70 drk-bg2 remove-bottom">
                <div class="container">
                    <div class="footer-data">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="wdgt-box style2">
                                    <div class="logo"><a href="index.html" title="Logo"><img src="<?php echo base_url('assets/logo-green-new.png') ?>" alt="logo2.png" style="max-width: 250px;"></a></div>
                                    <p>PT. SISPENJU AMANAH DIGITAL adalah perusahaan yang bergerak di bidang pemasaran paket perjalanan wisata khususnya perjalanan ibadah haji dan umroh, serta wisata muslim lainnya</p>
                                </div>
                                <a class="btn thm-btn brd-rd5 mb-5" href="<?php echo site_url('login') ?>" title="">Member Area</a>

                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="row">
                                    <div class="wdgt-box">
                                        <h4>Quick Links</h4>
                                        <ul>
                                            <li><a href="#home" title="">Beranda</a></li>
                                            <li><a href="#galeri" title="">Galeri</a></li>
                                            <li><a href="#kontak" title="">Kontak</a></li>
                                            <li><a href="#tentangkami" title="">Tentang Kami</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Footer Data -->
                    <div class="bottom-bar">
                        <p>Copyright 2020. All Rights Reserved.</p>
                    </div><!-- Bottom Bar -->
                </div>
            </div>
        </footer>
    </main><!-- Main Wrapper -->

    <script src="<?php echo base_url('assets/frontend/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/downCount.js') ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/fancybox.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/isotope.pkgd.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/perfectscrollbar.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/owl.carousel.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/jquery.circliful.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/custom-scripts.js') ?>"></script>
</body>

</html>