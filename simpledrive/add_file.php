<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['login'])) {

    require 'koneksi.php';
    $user = getUserById($_SESSION['id'], $conn);
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

        <link rel="stylesheet" href="../backend/css/upload-files.css">

        <!-- Favicon -->
        <link rel="shortcut icon" href="../assets/logo-teks.png" />

        <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
        <link rel="stylesheet" href="../assets/css/backend.css?v5">

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

        <!-- Kania -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
        <!-- Kania -->
    </head>

    <body class="  ">
        <?php
        if ($user) {
            $name = $user['nama_lengkap'];
            $id = $user['id_akun'];
            $feedback = [];
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
                        </nav>
                    </div>
                </div>

                <div class="content-page">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-between welcome-content mb-3">
                                    <h4>Upload Files</h4>
                                </div>
                            </div>
                        </div>
                        <div class="icon icon-grid i-grid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-block card-stretch card-height">
                                        <div class="card-body">
                                            <!-- isi -->
                                            <!-- <div class="container"> -->
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-6">
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <input type="file" class="form-control-file" name="file" id="file">
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary">Unggah</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
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
                            <div id="resolte-contaniner" style="height: 500px;" class="overflow-auto">
                                File not found
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {
            header("Location: index.php");
            exit;
        } ?>
    </body>

    </html>

<?php } else {
    header("Location: index.php");
    exit;
} ?>

<!-- KODE NYA DINA YANG NGERJAIN-->

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // check if file was uploaded
    if (isset($_FILES["file"])) {
        // set target file
        $target_dir = "uploads/";

        // $unique_prefix = uniqid(); // string acak
        // $timestamp = time(); // timestamp saat file diupload
        $filename = $id . ' -$- ' . basename($_FILES["file"]["name"]);
        $target_file = $target_dir . $filename;

        $sql = "SELECT * FROM dokumen WHERE id_akun='$id' AND namaDokumen LIKE '%$filename%'";
        $cekFIle = $conn->query($sql);

        // check if file already exists
        if (file_exists($target_file) && mysqli_num_rows($cekFIle) > 0) {
            echo "Maaf, File sudah ada.";
            exit;
        }

        // check file size
        if ($_FILES["file"]["size"] > 500000000) {
            echo "Maaf, Ukuran file terlalu besar.";
            exit;
        }

        // allow certain file formats
        //$allowed_types = array("pdf", "doc", "docx", "xls", "xlsx", "ods", "csv", "txt", "ppt", "pptx", "jpg", "jpeg", "bmp", "gif", "png", "mp4", "avi", "mov", "mp3");
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        //if (!in_array($file_type, $allowed_types)) {
           // echo "Maaf, hanya file PDF, DOC, DOCX, dan TXT yang diizinkan.";
           // exit;
       // }

        // move uploaded file to target directory 
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // read file content
            $file_content = file_get_contents($target_file);

            // delete uploaded file
            // unlink($target_file);

            // insert file into database
            $sql = "INSERT INTO dokumen (id_akun, tipeDokumen, namaDokumen, tglUpload) VALUES ('$id', '$file_type', '" . $conn->real_escape_string($filename) . "', NOW())";
            if ($conn->query($sql) === TRUE) {
                echo "<script> 
                    alert('File Berhasil Ditambahkan');
                    document.location.href = 'page-files.php';
                    </script>";
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file ke database: " . $conn->error;
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    } else {
        // file not uploaded yet
        // show form to upload file
    }
} else {
    // show form to upload file
}
?>



<!-- sampe sini dina-->