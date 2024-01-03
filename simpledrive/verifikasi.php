<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['id']) && isset($_SESSION['login'])) {
    $user = getUserById($_SESSION['id'], $conn);

    if($user){
       header('location:page-files.php');
    }
}
$email = "";
if (isset($_GET['email'])) {
    $email = $_GET['email'];
}else{
    echo '<script>window.history.back();</script>';
}

if (isset($_POST['verifikasi'])) {
    $email = $_POST['email'];
    $kode = $_POST['otp'];

    $sql = "SELECT * FROM akun WHERE email ='$email'";
    $user = $conn->query($sql);

    if (mysqli_num_rows($user) > 0) {
        $d = mysqli_fetch_array($user);

        if ($d['kode_otp'] == $kode) {
            $query = "UPDATE akun SET status = 1 WHERE username = '".$d['username']."'";
            $result = $conn->query($query);
            echo "<script>
                alert('Akun berhasil di verifikasi, silahkan Sign in');
            </script>";
            header('location: auth-sign-in.php');
        } else {
            echo "<script>
                alert('Verifikasi Gagal, Salah Kode OTP')
            </script>";
        }
    } else {
        echo "<script>
                alert('Akun tidak ditemukan, silahkan daftar ulang');
            </script>";
        header('location: auth-sign-up.php');
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SimpleDrive</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/logo-teks.png" />

    <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../assets/css/backend.css?v=1.0.0">

    <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">

    <!-- Viewer Plugin -->
    <!--PDF-->
    <link rel="stylesheet" href="../assets/vendor/doc-viewer/include/pdf/pdf.viewer.css">
    <!--Docs-->
    <!--PPTX-->
    <link rel="stylesheet" href="../assets/vendor/doc-viewer/include/PPTXjs/css/pptxjs.css">
    <link rel="stylesheet" href="../assets/vendor/doc-viewer/include/PPTXjs/css/nv.d3.min.css">
    <!--All Spreadsheet -->
    <link rel="stylesheet" href="../assets/vendor/doc-viewer/include/SheetJS/handsontable.full.min.css">
    <!--Image viewer-->
    <link rel="stylesheet" href="../assets/vendor/doc-viewer/include/verySimpleImageViewer/css/jquery.verySimpleImageViewer.css">
    <!--officeToHtml-->
    <link rel="stylesheet" href="../assets/vendor/doc-viewer/include/officeToHtml/officeToHtml.css">
</head>

<body class=" ">
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->

<div class="wrapper">
    <section class="login-content">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center height-self-center">
                <div class="col-md-7 col-sm-12 col-12 align-self-center">
                    <div class="sign-user_card" style="box-shadow: 0.5px 5px 5px 5px rgba(100, 100, 100, 0.2);">
                        <!-- <img src="../assets/images/logo-white.png" class="img-fluid rounded-normal darkmode-logo logo" alt="logo"> -->
                        <h1 class="ri-mail-line"></h1>
                        <br>
                        <h3 class="mb-3">Silahkan Cek Email</h3>
                        <p><b><?php echo $email ?></b></p>
                        <form action="verifikasi.php" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <input class="floating-input form-control" type="email" name = "email" value="<?php echo $email ?>" hidden>
                                    <div class="floating-label form-group">
                                        <input class="floating-input form-control" type="text" name = "otp" required>
                                        <label>KODE OTP</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="verifikasi" class="btn btn-primary">Verifikasi</button>
                            <p class="mt-3">
                                Belum menerima kode email? Silahkan cek SPAM
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Backend Bundle JavaScript -->
<script src="../assets/js/backend-bundle.min.js"></script>

<!-- Chart Custom JavaScript -->
<script src="../assets/js/customizer.js"></script>

<!-- Chart Custom JavaScript -->
<script src="../assets/js/chart-custom.js"></script>

<!--PDF-->
<script src="../assets/vendor/doc-viewer/include/pdf/pdf.js"></script>
<!--Docs-->
<script src="../assets/vendor/doc-viewer/include/docx/jszip-utils.js"></script>
<script src="../assets/vendor/doc-viewer/include/docx/mammoth.browser.min.js"></script>
<!--PPTX-->
<script src="../assets/vendor/doc-viewer/include/PPTXjs/js/filereader.js"></script>
<script src="../assets/vendor/doc-viewer/include/PPTXjs/js/d3.min.js"></script>
<script src="../assets/vendor/doc-viewer/include/PPTXjs/js/nv.d3.min.js"></script>
<script src="../assets/vendor/doc-viewer/include/PPTXjs/js/pptxjs.js"></script>
<script src="../assets/vendor/doc-viewer/include/PPTXjs/js/divs2slides.js"></script>
<!--All Spreadsheet -->
<script src="../assets/vendor/doc-viewer/include/SheetJS/handsontable.full.min.js"></script>
<script src="../assets/vendor/doc-viewer/include/SheetJS/xlsx.full.min.js"></script>
<!--Image viewer-->
<script src="../assets/vendor/doc-viewer/include/verySimpleImageViewer/js/jquery.verySimpleImageViewer.js"></script>
<!--officeToHtml-->
<script src="../assets/vendor/doc-viewer/include/officeToHtml/officeToHtml.js"></script>
<script src="../assets/js/doc-viewer.js"></script>
<!-- app JavaScript -->
<script src="../assets/js/app.js"></script>
</body>

</html>
