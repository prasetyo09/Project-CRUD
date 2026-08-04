<?php
session_start();
session_regenerate_id();

include "config/koneksi.php";

if (!isset($_SESSION['NAME'])) {
    header("location:index.php");
    exit();
}

//tampil semua data dari user
$query = mysqli_query($conn, "SELECT * FROM projects ORDER BY id DESC");
$rows  = mysqli_fetch_all($query, MYSQLI_ASSOC);

//jika params delete ada
if (isset($_GET['delete'])){
    $delete = $_GET ['delete'];
    $img = mysqli_query($conn, "SELECT image FROM projects WHERE id = '$delete'");
    $rowimg = mysqli_fetch_assoc($img);
    if ($delete && !empty($rowimg['image'])){
        $old_picture_path = "assets/img/" . $rowimg['image'];
        if(file_exists($old_picture_path)){
            unlink($old_picture_path);
        }
    }
    $delete = mysqli_query($conn, "DELETE FROM projects WHERE id='$delete'");
    header("location:projects.php?hapus=berhasil");
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
            <div
                class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                <h3 class="fw-bold mb-3">Projects</h3>
                <h6 class="op-7 mb-2">Page for user information</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                <!-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> -->
                <a href="create-projects.php" class="btn btn-primary btn-round">Create New Project</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-12">
                    <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Image</th>
                                <th>ACTION</th>
                            </tr>
                            <tbody>
                                <?php foreach($rows as $index => $row):?>
                                <tr>
                                    <td><?php echo $index + 1?></td>
                                    <td><?php echo $row['title'];?></td>
                                    <td><?php echo $row['subtitle'];?></td>
                                    <td>
                                        <img src="assets/img/<?php echo $row['image'];?>" width="176" class="shadow" alt="img.jpg">
                                    </td>
                                    <td>
                                        <a href="create-projects.php?edit=<?php echo $row['id']?>" class="btn btn-success btn-sm">Edit</a>
                                        <a onclick="return confirm('Are you sure want to delete this data?')" href="projects.php?delete=<?php echo $row['id']?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                            </thead>
                        </table>
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