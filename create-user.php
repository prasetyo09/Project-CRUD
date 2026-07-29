<?php
session_start();
session_regenerate_id();

include "config/koneksi.php";

if (!isset($_SESSION['NAME'])) {
    header("location:index.php");
    exit();
}

// Jika tombol simpan ditekan, maka data akan tersimpan
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($conn, "SELECT * FROM users WHERE id ='$id'");
$row  = mysqli_fetch_assoc($query);

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'] ? $_POST['password'] : $row['password'];

    if($id){
        $update = mysqli_query($conn, "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$id'");
        header("location:user.php?update=berhasil");

    } else{
        $insert = mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
        header("location:user.php?tambah=berhasil");
    }
    
}
//tampil semua data dari user

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Create User</title>
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
                    src="assets/kaiadmin-lite-1.2.0/assets/img/kaiadmin/logo_light.svg"
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
                        <h3 class="fw-bold mb-3"><?php echo isset($_GET['edit']) ? 'Edit User' : 'Create New User'?></h3>
                        <h6 class="op-7 mb-2"><?php echo isset($_GET['edit']) ? 'Edit your information' : 'Add a user based on the available information'?></h6>
                    </div>
                    <div class="ms-md-auto py-2 py-md-0">

                    </div>
                </div>
            <div class="row">
                <div class="col-sm-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Name</label>
                                    <label for="">:</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required value="<?php echo ($id) ? $row['name'] : ''?>">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Email</label>
                                    <label for="">:</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required value="<?php echo ($id) ? $row['email'] : ''?>"><br>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">
                                        <?php echo ($id) ? 'Password <small class="text-secondary">(leave blank if you do not wish to change it)</small>' : 'Password'?>
                                    </label>
                                    <label for="">:</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" <?php echo ($id) ? '' : 'required'?>>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary rounded-4" name="save" type="submit">Save</button>
                                    <button class="btn btn-outline-primary rounded-4" type="reset">Reset</button>
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