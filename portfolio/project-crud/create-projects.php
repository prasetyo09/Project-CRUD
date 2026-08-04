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
$query = mysqli_query($conn, "SELECT * FROM projects WHERE id ='$id'");
$row  = mysqli_fetch_assoc($query);

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $image = $_FILES['image'];

    if ($image['error'] == 0) {
        $filename = uniqid() . "_" . basename($image['name']);
        $filepath = "assets/img/" . $filename;

        if ($id && !empty($row['image'])){
            $old_picture_path = "assets/img/" . $row['image'];
            if(file_exists($old_picture_path)){
                unlink($old_picture_path);
            }
        }

        move_uploaded_file($image['tmp_name'],  $filepath);

        if($id){
            $update = mysqli_query($conn, "UPDATE projects SET title='$title', subtitle='$subtitle', image='$filename' WHERE id='$id'");
            header("location:projects.php?update=berhasil");

        } else{
            $insert = mysqli_query($conn, "INSERT INTO projects (title, image, subtitle ) VALUES ('$title','$filename',  '$subtitle')");
            header("location:projects.php?tambah=berhasil");
        }
    } else {
        $update = mysqli_query($conn, "UPDATE projects SET title='$title', subtitle='$subtitle' WHERE id='$id'");
        header("location:projects.php?update=berhasil");
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
                        <h3 class="fw-bold mb-3"><?php echo isset($_GET['edit']) ? 'Edit Project' : 'Create New Project'?></h3>
                        <h6 class="op-7 mb-2"><?php echo isset($_GET['edit']) ? 'Edit your information' : 'Add a user based on the available information'?></h6>
                    </div>
                    <div class="ms-md-auto py-2 py-md-0">

                    </div>
                </div>
            <div class="row">
                <div class="col-sm-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Title</label>
                                    <label for="">:</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" required value="<?php echo ($id) ? $row['title'] : ''?>">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Subtitle</label>
                                    <label for="">:</label>
                                    <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Enter subtitle" required value="<?php echo ($id) ? $row['subtitle'] : ''?>"><br>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label fw-bold">Image</label>
                                    <label for="">:</label>
                                    <input type="file" name="image" src="" alt="" value="<?php echo($id) ? $row['image'] : ''?>">
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