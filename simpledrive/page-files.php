<?php

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['login'])) {

    require 'koneksi.php';
    $user = getUserById($_SESSION['id'], $conn);
?>

    <?php

    if (isset($_GET['ubah'])) {

        $id = $user['id_akun'];

        $hasil = mysqli_query($conn, "SELECT * FROM dokumen WHERE id_akun = '$id'");
        $row = mysqli_fetch_array($hasil);

        $id_file = $_GET['idfel'];
        $nama_lama = $_GET['nama'];
        $format = $_GET['tipefel'];

        $namaDokumen = $_GET['namaDokumen'];
        $unique_prefix = uniqid(); // string acak
        $timestamp = time(); // timestamp saat file diupload
        $namabaru = $id  . ' -$- ' . $namaDokumen . "." . $format;

        $sql = "SELECT * FROM dokumen WHERE id_akun='$id' AND tipeDokumen='$format' AND namaDokumen LIKE '%$namabaru%'";
        $cekFIle = $conn->query($sql);

        // check if file already exists
        if (mysqli_num_rows($cekFIle) > 0) {
            echo " 
                    <script> 
                    alert('Maaf, nama file sudah digunakan');
                    document.location.href = 'page-files.php';
                    </script>
                ";
            exit;
        }

        $query = "UPDATE dokumen SET
                namaDokumen ='$namabaru'
                WHERE id = '$id_file'";

        if (rename("uploads/" . $_GET['namafelful'], "uploads/" . $namabaru)) {
            $result = mysqli_query($conn, $query);
            echo " 
                    <script> 
                    alert('Updating data has DONE');
                    document.location.href = 'page-files.php';
                    </script>
                ";
        } else {
            echo " 
                    <script> 
                    alert('FAILED Updating Data!');
                    </script>
                ";
        }
    }

    ?>


    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>SimpleDrive</title>
        <!-- Profile -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/profile.css">

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


    <body class="  ">
        <?php
        if ($user) {
            $name = $user['nama_lengkap'];
            $id = $user['id_akun'];
            $feedback = [];

            if (isset($_POST['keyword'])) {
                // $keyword = $_POST['keyword'];
                // $query = mysqli_query($conn, );
                $feedback = cariDokumen($_POST['keyword'], $id);
            } else {
                $query = mysqli_query($conn, "SELECT * FROM dokumen WHERE id_akun = '$id'");
                // $feedback = query("SELECT * FROM dokumen WHERE username = '$username_'");
                while ($row = mysqli_fetch_assoc($query)) {
                    $feedback[] = $row;
                }
            }
        ?>
            <!-- loader Start -->
            <div id="loading">
                <div id="loading-center">
                </div>
            </div>
            <!-- loader END -->
            <!-- Wrapper Start -->
            <div class="wrapper">

                <div class="iq-sidebar  sidebar-default ">
                    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
                        <a href="#" class="header-logo">
                            <img src="../assets/logo.png" class="img-fluid rounded-normal light-logo img-responsive" alt="logo" width="85" height="60">
                            <img src="../assets/logo-SD.png" class="img-fluid rounded-normal light-logo img-responsive" alt="logo" width="110" height="80">
                            <!-- <h5>SimpleDrive</h5> -->
                        </a>
                        <div class="iq-menu-bt-sidebar">
                            <i class="las la-bars wrapper-menu"></i>
                        </div>
                    </div>
                    <div class="data-scrollbar" data-scroll="1">
                        <div class="new-create select-dropdown input-prepend input-append">
                            <div class="btn-group">
                                <div class="search-query selet-caption"><a href="add_file.php"><i class="las la-plus pr-2"></i>Tambah</a></div><span class="search-replace"></span>
                                <span class="caret"><!--icon--></span>
                            </div>
                        </div>
                        <nav class="iq-sidebar-menu">
                            <ul id="iq-sidebar-toggle" class="iq-menu">
                                <!-- <li class=" ">
                            <a href="../backend/index.php" class="">
                                <i class="las la-home iq-arrow-left"></i><span>Dashboard</span>
                            </a>
                            <ul id="dashboard" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            </ul>
                        </li> -->

                                <li class="active">
                                    <a href="page-files.php" class="">
                                        <i class="lar la-file-alt iq-arrow-left"></i><span>All My Files</span>
                                    </a>
                                    <ul id="page-files" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                    </ul>
                                </li>

                                <li class=" ">
                                    <a href="#mydrive" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                        <i class="las la-id-card"></i><span>Profile</span>
                                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                    </a>
                                    <ul id="mydrive" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                        <li class="nav-item nav-icon dropdown caption-content">
                                            <div class="card mb-0">
                                                <div class="card-header d-flex justify-content-between align-items-center mb-0">
                                                    <div class="header-title">
                                                        <h4 class="card-title mb-0">Profile</h4>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="profile-header">
                                                        <div class="cover-container text-center">
                                                            <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
                                                                <div class="upload">
                                                                    <?php
                                                                    $Username = $user["username"];
                                                                    $image = $user["image"];
                                                                    ?>
                                                                    <img src="images/<?php echo $image; ?>" width=125 height=125 title="<?php echo $name; ?>">
                                                                    <div class="round">
                                                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                        <input type="hidden" name="name" value="<?php echo $Username; ?>">
                                                                        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                                                                        <i class="fa fa-camera" style="color: #fff;"></i>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <script type="text/javascript">
                                                                document.getElementById("image").onchange = function() {
                                                                    document.getElementById("form").submit();
                                                                };
                                                            </script>

                                                            <?php
                                                            if (isset($_FILES["image"]["name"])) {
                                                                $id = $_POST["id"];
                                                                $name = $_POST["name"];

                                                                $imageName = $_FILES["image"]["name"];
                                                                $imageSize = $_FILES["image"]["size"];
                                                                $tmpName = $_FILES["image"]["tmp_name"];

                                                                // Image validation
                                                                $validImageExtension = ['jpg', 'jpeg', 'png'];
                                                                $imageExtension = explode('.', $imageName);
                                                                $imageExtension = strtolower(end($imageExtension));
                                                                if (!in_array($imageExtension, $validImageExtension)) {
                                                                    echo
                                                                    "
                                                                        <script>
                                                                            alert('Invalid Image Extension');
                                                                            document.location.href = 'page-files.php';
                                                                        </script>
                                                                        ";
                                                                } elseif ($imageSize > 1200000) {
                                                                    echo
                                                                    "
                                                                        <script>
                                                                        alert('Image Size Is Too Large');
                                                                        document.location.href = 'page-files.php';
                                                                        </script>
                                                                        ";
                                                                } else {
                                                                    $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
                                                                    $newImageName .= '.' . $imageExtension;
                                                                    $query = "UPDATE akun SET image = '$newImageName' WHERE id_akun = $id";
                                                                    mysqli_query($conn, $query);
                                                                    move_uploaded_file($tmpName, 'images/' . $newImageName);
                                                                    echo
                                                                    "
                                                                            <script>
                                                                            document.location.href = 'page-files.php';
                                                                            </script>
                                                                            ";
                                                                }
                                                            }
                                                            ?>
                                                            <div class="profile-detail mt-3">

                                                                <h5>
                                                                    <?php echo $name; ?></a>
                                                                </h5>
                                                                <p>
                                                                    <?php echo $user['email']; ?>
                                                                </p>
                                                            </div>
                                                            <a href="auth-sign-out.php" class="btn btn-primary justify-content-center d-flex">Sign Out</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <div class="p-3"></div>
                    </div>
                </div>
                <div class="iq-top-navbar">
                    <div class="iq-navbar-custom">
                        <nav class="navbar navbar-expand-lg navbar-light p-0">
                            <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                                <i class="ri-menu-line wrapper-menu"></i>
                                <a href="#" class="header-logo">
                                    <img src="../assets/logo.png" class="img-fluid rounded-normal light-logo" alt="logo">
                                    <!-- <img src="../assets/images/logo-white.png" class="img-fluid rounded-normal darkmode-logo" alt="logo"> -->
                                </a>
                            </div>
                            <div class="iq-search-bar device-search">
                                <form method="POST" action="">
                                    <div class="input-prepend input-append">
                                        <label class="dropdown-toggle searchbox" name="search" data-toggle="dropdown">
                                            <input class="dropdown-toggle search-query text search-input" name="keyword" type="text" placeholder="Cari file..."><span class="search-replace"></span>
                                            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                        </label>
                                    </div>
                                </form>
                            </div>

                            <div class="d-flex align-items-center">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                                    <i class="ri-menu-3-line"></i>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                        <li class="nav-item nav-icon search-content">
                                            <a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-search-line"></i>
                                            </a>
                                            <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                                <form method="POST" action="" class="searchbox p-2">
                                                    <div class="form-group mb-0 position-relative">
                                                        <input type="text" class="text search-input font-size-12" name="keyword" placeholder="Cari file...">
                                                        <a href="#" class="search-link"><i class="las la-search"></i></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>
                                        <li class="nav-item nav-icon dropdown">
                                            <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-question-line"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="content-page">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-between welcome-content mb-3">
                                    <h4>All Files</h4>
                                </div>
                            </div>
                        </div>

                        <!--------- LIST FILES ---------->
                        <div class="icon icon-grid i-grid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-block card-stretch card-height">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-borderless tbl-server-info">
                                                    <thead>
                                                        <!-- DITA NAMPILIN FILE-->
                                                        <tr>
                                                            <th scope="col">Nama</th>
                                                            <th scope="col">Tipe Dokumen</th>
                                                            <th scope="col">Tanggal Ditambahkan</th>
                                                            <th scope="col">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        foreach ($feedback as $kmn) :
                                                            $filename = $kmn["namaDokumen"];
                                                            $PisahNamaFile = explode("-$- ", $filename);
                                                            $namafile = $PisahNamaFile[1]; // mengambil elemen kedua dari array
                                                            $Pisahnamafileaja = explode(".", $namafile);
                                                            $namafileaja = $Pisahnamafileaja[0];
                                                            $filepath = "uploads/$filename";
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <!-- LOGO FILE SEBELAH NAMA FILE -->
                                                                        <!-- <div class="icon-small bg-danger rounded mr-3">
                                                                    <i class="ri-file-excel-line"></i>
                                                                </div> -->
                                                                        <!-- BUAT LIAT FILENYA -->
                                                                        <?php if (in_array($kmn["tipeDokumen"], array("txt", "jpg", "jpeg", "bmp", "gif", "png", "mp4", "avi", "mov", "mp3", "pptx"))) : ?>
                                                                            <a href="<?php echo $filepath ?>" style="text-decoration: none; color: #535f6b;">
                                                                                <?php echo $namafile; ?>
                                                                            </a>
                                                                        <?php elseif ($kmn["tipeDokumen"] == 'pdf') : ?>
                                                                            <div data-load-file="file" data-load-target="#resolte-contaniner" data-url="<?php echo $filepath ?>" data-toggle="modal" data-target="#exampleModal" data-title="<?php echo $namafile; ?>" style="cursor: pointer;">
                                                                                <?php echo $namafile; ?>
                                                                            </div>
                                                                        <?php elseif ($kmn["tipeDokumen"] == 'ppt' || $kmn["tipeDokumen"] === 'pptx') : ?>
                                                                            <!-- <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?php #echo $filepath; ?>" frameborder="0"><?php echo $namafile; ?></iframe> -->
                                                                        <?php else : ?>
                                                                            <div data-load-file="file" data-load-target="#resolte-contaniner" data-url="<?php echo $filepath ?>" data-toggle="modal" data-target="#exampleModal" data-title="<?php echo $namafile ?>" style="cursor: pointer;">
                                                                                <?php echo $namafile; ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <!-- <div data-load-file="file"
                                                                            data-load-target="#resolte-contaniner"
                                                                            data-url="<?php #echo $filepath ?>" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            data-title="<?php #echo $namafile; ?>"
                                                                            style="cursor: pointer;">
                                                                            <?php #echo $namafile; ?> -->
                                                                        <!-- </div> -->
                                                                        <!-- <a href="<?php #echo $filepath ?>"><?php #echo $namafile; ?></a> -->
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php echo $kmn["tipeDokumen"]; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $kmn["tglUpload"]; ?>
                                                                </td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <span class="dropdown-toggle" id="dropdownMenuButton10" data-toggle="dropdown">
                                                                            <i class="ri-more-fill"></i>
                                                                        </span>
                                                                        <!-- Klik icon dots file -->
                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton10">
                                                                            <a class="dropdown-item" href="unduh_file.php?id=<?= $kmn['id']; ?>"><i class="ri-file-download-fill mr-2"></i>Unduh
                                                                                File</a>
                                                                            <!-- <a class="dropdown-item" href="rename.php?id=<?= $kmn['id'] ?>"><i class="ri-pencil-fill mr-2"></i>Ubah Nama</a> -->

                                                                                <a href="page-files.php?id=<?= $kmn['id']?>" class="dropdown-item" data-toggle="modal" data-target="#basicModal<?php echo $i ?>" ><i class="ri-pencil-fill mr-2"></i>Ubah Nama</a>

                                                                            <a class="dropdown-item" href="delete_file.php?id=<?= $kmn['id']; ?>"><i class="ri-delete-bin-6-fill mr-2"></i>Hapus</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <div class="modal fade" id="basicModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel">Ubah Nama</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="get">
                                                                                <div class="form-group">
                                                                                    <label for="new_filename">Nama file baru :</label>
                                                                                    <input type="text" class="form-control" id="namaDokumen" name="namaDokumen" value="<?php ECHO $namafileaja ?>">
                                                                                    <input type="text" name="nama" value="<?php ECHO $namafileaja ?>" hidden>
                                                                                    <input type="text" name="idfel" value="<?php ECHO $kmn['id'] ?>" hidden>
                                                                                    <input type="text" name="tipefel" value="<?php ECHO  $kmn['tipeDokumen']?>" hidden>
                                                                                    <input type="text" name="namafelful" value="<?php ECHO  $kmn['namaDokumen']?>" hidden>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" name="ubah" class="btn btn-primary">Ubah nama</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php $i++;
                                                        endforeach;


                                                        ?>
                                                    </tbody>
                                                    <!--SAMPE SINI-->
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Wrapper End-->
            <footer class="iq-footer">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-6 text-left">
                            <span class="mr-1">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>©
                            </span> <a href="#" class="">SimpleDrive</a>.
                        </div>
                    </div>
                </div>
            </footer>
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
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Title</h4>
                            <div>
                                <a class="btn" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <iframe src="https://docs.google.com/viewer?url=<?php echo $filepath; ?>&embedded=true" style="width:800px; height:600px;"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {
            header("Location: index.php");
            exit;
        } ?>



        <!-- POP UP RENAME -->


        <!-- POP UP RENAME -->
        <script>
            $(document).on("click", "#cust_btn", function() {

                $("#myModal").modal("toggle");

            })


        </script>

    </body>

    </html>

<?php } else {
    header("Location: index.php");
    exit;
} ?>


