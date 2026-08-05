<?php
// Jika tombol simpan ditekan, maka data akan tersimpan
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($conn, "SELECT * FROM users WHERE id ='$id'");
$row  = mysqli_fetch_assoc($query);

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'] ? $_POST['password'] : $row['password'];
    $pass = sha1($password);

    $select = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    $checkEmail = mysqli_fetch_assoc($select);

    if ($checkEmail) {
        header("location:app.php?page=create-user&email=gagal");
    }

    if($id){
        $update = mysqli_query($conn, "UPDATE users SET name='$name', email='$email', password='$pass' WHERE id='$id'");
        header("location:app.php?page=user&update=berhasil");

    } else{
        $insert = mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$pass')");
        header("location:app.php?page=user&tambah=berhasil");
    }
    
}
//tampil semua data dari user

?>
<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3"><?php echo isset($_GET['edit']) ? 'Edit User' : 'Create New User'?></h3>
        <h6 class="op-7 mb-2"><?php echo isset($_GET['edit']) ? 'Edit your information' : 'Add a user based on the available information'?></h6>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <?php
                if (isset ($_GET['email']) && $_GET['email'] == 'gagal') {
                ?>
                <div class="alert alert-danger" role="alert">
                    Email sudah ada!!!
                </div>
                <?php
                }
                ?>
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