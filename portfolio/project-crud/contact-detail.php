<?php
session_start();
session_regenerate_id();

include "config/koneksi.php";

if (!isset($_SESSION['NAME'])) {
    header("location:index.php");
    exit();
}

//tampil semua data dari user
$id = isset($_GET['id']) ? $_GET['id'] : '';
$query = mysqli_query($conn, "SELECT * FROM contact WHERE id = '$id' ");
$row  = mysqli_fetch_assoc($query);

//jika params delete ada
if (isset($_GET['delete'])){
    $delete = $_GET ['delete'];
    $delete = mysqli_query ($conn, "DELETE FROM contact WHERE id='$delete'");
    header("location:contact.php?hapus=berhasil");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Contact</title>
    <meta
        content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
        name="viewport" />
    <?php
    include "inc/css.php";
    ?>

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php
        include "inc/sidebar.php";
        ?>
        <!-- End Sidebar -->

        <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <a href="index.html" class="logo">
                <img
                    src="assets/img/kaiadmin/logo_light.svg"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20" />
                </a>
                <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
                </div>
                <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
            <!-- End Logo Header -->
            </div>
            <!-- Navbar Header -->
            <?php
            include "inc/navbar.php";
            ?>
            <!-- End Navbar -->
        </div>

        <div class="container">
            <div class="page-inner">
            <div
                class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Contact Detail</h3>
                    <h6 class="op-7 mb-2">Contact Page</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="" class="form-label fw-bold">Name</label>
                                    <label for="" class="form-label fw-bold">:</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $row['name'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label fw-bold">Email</label>
                                    <label for="" class="form-label fw-bold">:</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $row['email'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label fw-bold">Subject</label>
                                    <label for="" class="form-label fw-bold">:</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $row['subject']?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="" class="form-label fw-bold">Message</label>
                                    <label for="" class="form-label fw-bold">:</label>
                                    <textarea name="message" id="" class="form-control" readonly><?php echo $row['message']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
                <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="http://www.themekita.com">
                    ThemeKita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Help </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Licenses </a>
                </li>
                </ul>
            </nav>
            <div class="copyright">
                2024, made with <i class="fa fa-heart heart text-danger">Prasetyo Ari Nugroho</i> by
                <a href="http://www.themekita.com">ThemeKita</a>
            </div>
            <div>
                Distributed by
                <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
            </div>
            </div>
        </footer>
        </div>

    <!-- Custom template | don't include it in your project! -->
    <!-- End Custom template -->
    </div>
    <?php
    include "inc/js.php";
    ?>
</body>

</html>