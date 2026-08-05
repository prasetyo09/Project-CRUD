<?php
ob_start();
session_start();
session_regenerate_id();

include "config/koneksi.php";

if (!isset($_SESSION['NAME'])) {
    header("location:index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Portofolio Web Admin</title>
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
                    <!-- GET : URL ?id, ?edit, ?delete -->
                    <?php
                    if (isset($_GET['page'])) {
                        //file_exists
                        if (file_exists($_GET['page'] . '.php')) {
                            include $_GET['page'] . '.php';
                        } else {
                            include 'notfound.php';
                        }
                    }
                    ?>
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