<?php
    session_start();
    require 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SIMPLE DRIVE</title>
        <!-- Favicon-->
        <!-- Custom Google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
                <div class="container px-5">
                    <a class="navbar-brand" href="index.html"><span class="fw-bolder text-primary">SIMPLEDRIVE</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                            <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Header-->
            <header class="py-5">
                <div class="container px-5 pb-5">
                    <div class="row gx-5 align-items-center">
                        <div class="col-xxl-5">
                            <!-- Header text content-->
                            <div class="text-center text-xxl-start">
                                <div class="badge bg-gradient-primary-to-secondary text-white mb-4"><div class="text-uppercase">&middot; MAKE YOUR LIFE EASIER &middot;</div></div>
                                <div class="fs-3 fw-light text-muted">Terms And Condition USER SimpleDrive</div>
                                <br>
                            </div>
                        </div>

                       
                            <br><br>
                            <h1>Selamat datang di SimpleDrive!</h1> <br>
                            <p>Dengan mengakses dan menggunakan situs web ini, Anda menyetujui dan tunduk pada ketentuan berikut ini. <br>
                            Jika Anda tidak setuju dengan salah satu ketentuan ini, Anda tidak diperbolehkan menggunakan layanan kami. <br><br> </p>

                            <h3>1. Penggunaan Layanan</h3> <br>
                            <p>
                            [A] SimpleDrive menyediakan platform untuk mengakses, menyimpan, dan mengelola database. Anda dapat menggunakan layanan kami untuk tujuan pribadi atau bisnis, selama Anda mematuhi persyaratan yang ditetapkan dalam dokumen ini. <br>
                            [B] Anda bertanggung jawab sepenuhnya atas semua konten yang Anda unggah, simpan, atau bagikan melalui SimpleDrive. Anda harus memastikan bahwa konten tersebut tidak melanggar hukum, tidak melanggar hak kekayaan intelektual pihak lain, atau tidak melanggar ketentuan atau kebijakan lain yang berlaku. <br><br>
                            </p>

                            <h3>2. Akun Pengguna</h3> <br>
                            <p>
                            [A] Untuk menggunakan layanan SimpleDrive, Anda harus membuat akun pengguna. Anda bertanggung jawab menjaga keamanan informasi akun Anda dan tidak membagikan detail masuk Anda kepada pihak ketiga. <br>
                            [B] Anda bertanggung jawab penuh atas segala aktivitas yang terjadi di bawah akun Anda. SimpleDrive tidak bertanggung jawab atas kerugian atau kerusakan yang timbul akibat penggunaan tidak sah atau tidak sesuai oleh pihak lain. <br><br>
                            </p>

                            <h3>3. Hak Kekayaan Intelektual</h3> <br>
                            <p>
                            [A] SimpleDrive dan kontennya (seperti teks, grafik, logo, ikon, dan materi lainnya) dilindungi oleh hak cipta dan hak kekayaan intelektual lainnya. Anda tidak diperbolehkan menggunakan, mendistribusikan, atau menggandakan materi tersebut tanpa izin tertulis dari SimpleDrive. <br>
                            [B] Anda menyediakan SimpleDrive dengan lisensi non-eksklusif untuk menggunakan konten yang Anda unggah melalui layanan kami. Ini berarti SimpleDrive memiliki hak untuk menyimpan, memperbanyak, dan mentransmisikan konten Anda untuk tujuan operasional SimpleDrive. <br><br>
                            </p>

                            <h3>4. Batasan Tanggung Jawab</h3> <br>
                            <p>
                            [A] SimpleDrive berusaha memberikan layanan yang andal dan aman, namun kami tidak memberikan jaminan bahwa layanan kami akan selalu bebas dari gangguan, kesalahan, atau kehilangan data. <br>
                            [B] Anda mengakui dan setuju bahwa penggunaan Anda atas layanan SimpleDrive adalah risiko Anda sendiri. SimpleDrive tidak bertanggung jawab atas kerugian langsung, tidak langsung, khusus, atau konsekuensial yang timbul. <br><br>
                            </p>
                    </div>
                </div>
            </header>
            <!-- About Section-->
            <!-- <section class="bg-light py-5">
                <div class="container px-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-xxl-8">
                            <div class="text-center my-5">
                                <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">About Me</span></h2>
                                <p class="lead fw-light mb-4">My name is Start Bootstrap and I help brands grow.</p>
                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit dolorum itaque qui unde quisquam consequatur autem. Eveniet quasi nobis aliquid cumque officiis sed rem iure ipsa! Praesentium ratione atque dolorem?</p>
                                <div class="d-flex justify-content-center fs-2 gap-4">
                                    <a class="text-gradient" href="#!"><i class="bi bi-twitter"></i></a>
                                    <a class="text-gradient" href="#!"><i class="bi bi-linkedin"></i></a>
                                    <a class="text-gradient" href="#!"><i class="bi bi-github"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
        </main>
        <!-- Footer-->
        <!-- <footer class="bg-white py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0">Copyright &copy; Your Website 2023</div></div>
                    <div class="col-auto">
                        <a class="small" href="#!">Privacy</a>
                        <span class="mx-1">&middot;</span>
                        <a class="small" href="#!">Terms</a>
                        <span class="mx-1">&middot;</span>
                        <a class="small" href="#!">Contact</a>
                    </div>
                </div>
            </div>
        </footer> -->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
