<?php
// Jika tombol simpan ditekan, maka data akan tersimpan
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($conn, "SELECT * FROM sliders WHERE id ='$id'");
$row  = mysqli_fetch_assoc($query);

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $button1_text = $_POST['button1_text'];
    $button1_link = $_POST['button1_link'];
    $button2_text = $_POST['button2_text'];
    $button2_link = $_POST['button2_link'];
    $is_active = $_POST['is_active'];
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
            $update = mysqli_query($conn, "UPDATE sliders SET title = '$title', subtitle = '$subtitle', description = '$description', button1_text = '$button1_text', button1_link = '$button1_link', button2_text = '$button2_text', button2_link = '$button2_link', image = '$filename', is_active = '$is_active' WHERE id='$id'");
            header("location:app.php?page=slider&update=berhasil");

        } else {
            $insert = mysqli_query($conn, "INSERT INTO sliders (title, subtitle, description, button1_text, button1_link, button2_text, button2_link, image, is_active) VALUES ('$title','$subtitle','$description','$button1_text','$button1_link','$button2_text','$button2_link', '$filename', '$is_active')");
            header("location:app.php?page=slider&tambah=berhasil");
        }
    } else{
        $update = mysqli_query($conn, "UPDATE sliders SET title = '$title', subtitle = '$subtitle', description = '$description', button1_text = '$button1_text', button1_link = '$button1_link', button2_text = '$button2_text', button2_link = '$button2_link', is_active = '$is_active' WHERE id='$id'");
        header("location:app.php?page=slider&update=berhasil");
    }
}
//tampil semua data dari user

?>

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3"><?php echo isset($_GET['edit']) ? 'Edit Slide' : 'Create New Slide'?></h3>
        <h6 class="op-7 mb-2"><?php echo isset($_GET['edit']) ? 'Edit your image for sliders' : 'Add your information for homepage'?></h6>
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
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required value="<?php echo ($id) ? $row['title'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Subtitle</label>
                        <label for="">:</label>
                        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Enter Subtitle" required value="<?php echo ($id) ? $row['subtitle'] : ''?>"><br>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Text Button 1</label>
                        <label for="">:</label>
                        <input type="text" class="form-control" name="button1_text" id="button1_text" placeholder=" Enter Text Button" required value="<?php echo ($id) ? $row['button1_text'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Link Button 1</label>
                        <label for="">:</label>
                        <input type="url" class="form-control" name="button1_link" id="button1_link" placeholder="Enter Link Button" required value="<?php echo ($id) ? $row['button1_link'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Text Button 2</label>
                        <label for="">:</label>
                        <input type="text" class="form-control" name="button2_text" id="button2_text" placeholder=" Enter Text Button" required value="<?php echo ($id) ? $row['button2_text'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Link Button 2</label>
                        <label for="">:</label>
                        <input type="url" class="form-control" name="button2_link" id="button2_link" placeholder="Enter Link Button" required value="<?php echo ($id) ? $row['button2_link'] : ''?>"><br>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Image</label>
                        <label for="">:</label>
                        <input type="file" name="image" src="" alt="" value="<?php echo($id) ? $row['image'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Description</label>
                        <label for="">:</label>
                        <textarea name="description" id="description" class="form-control"><?php echo ($id) ? $row['description'] : ''?></textarea>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="is_active" id="is_active" value="1" checked <?php echo ($id) && $row['is_active'] == 1 ? "checked" : ''?>>
                        <label class="form-check-label" for="radioDefault1">Active</label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="is_active" value="0" <?php echo ($id) && $row['is_active'] == 0 ? "checked" : ''?>>
                        <label class="form-check-label" for="radioDefault2">Non-Active</label>
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