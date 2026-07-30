<?php
session_start();
session_regenerate_id();

include "config/koneksi.php";

if (!isset($_SESSION['NAME'])) {
    header("location:index.php");
    exit();
}

//tampil semua data dari user
$query = mysqli_query($conn, "SELECT * FROM settings LIMIT 1");
$row  = mysqli_fetch_assoc($query);


// jika tombol save ditekan
if (isset($_POST['save'])) {
    $website_name = $_POST['website_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $ig = $_POST['ig'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $id = $row['id'] ?? '';

    //jika data di dalam tabel setting ada
    if ($row) {
        mysqli_query($conn, "UPDATE settings SET 
        website_name = '$website_name', 
        email = '$email', 
        phone = '$phone', 
        ig = '$ig', 
        address = '$address', 
        description = '$description' WHERE id = $id "
        );
    }else {
        mysqli_query($conn, "INSERT INTO settings (website_name, email, phone, ig, address, description) VALUES ('$website_name', '$email','$phone','$ig','$address', '$description')");
    }

    header("location:settings.php");
}

//jika params delete ada
if (isset($_GET['delete'])){
    $delete = $_GET ['delete'];
    $delete = mysqli_query ($conn, "DELETE FROM users WHERE id='$delete'");
    header("location:user.php?hapus=berhasil");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>User Page</title>
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
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                    <div>
                        <h3 class="fw-bold mb-3">Settings</h3>
                        <h6 class="op-7 mb-2">Settings Option</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Website Name</label>
                                                <label for="" class="form-label fw-bold">:</label>
                                                <input type="url" name="website_name" id="website_name" class="form-control" required value="<?php echo isset($row) ? $row['website_name'] : '' ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Phone</label>
                                                <label for="" class="form-label fw-bold">:</label>
                                                <input type="text" name="phone" id="phone" class="form-control" required value="<?php echo isset($row) ? $row['phone'] : '' ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Email</label>
                                                <label for="" class="form-label fw-bold">:</label>
                                                <input type="email" name="email" id="email" class="form-control" required value="<?php echo isset($row) ? $row['email'] : '' ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Instagram Link</label>
                                                <label for="" class="form-label fw-bold">:</label>
                                                <input type="url" name="ig" id="ig" class="form-control" value="<?php echo isset($row) ? $row['ig'] : '' ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Address</label>
                                                <label for="" class="form-label fw-bold">:</label>
                                                <textarea name="address" id="address" class="form-control"><?php echo isset($row) ? $row['address'] : '' ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-bold">Description</label>
                                                <label for="" class="form-label fw-bold">:</label>
                                                <textarea name="description" id="description" class="form-control"><?php echo isset($row) ? $row['description'] : '' ?></textarea>
                                            </div>
                                            <button class="btn btn-primary" type="submit" name="save">Save</button>
                                            <button class="btn btn-outline-primary rounded-4" type="reset">Reset</button>
                                        </div>
                                    </div>
                                </form>
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