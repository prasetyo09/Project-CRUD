<?php
//tampil semua data dari user
$query = mysqli_query($conn, "SELECT * FROM sliders ORDER BY id DESC");
$rows  = mysqli_fetch_all($query, MYSQLI_ASSOC);

//jika params delete ada
if (isset($_GET['delete'])){
    $delete = $_GET ['delete'];
    $img = mysqli_query($conn, "SELECT image FROM sliders WHERE id = '$delete'");
    $rowimg = mysqli_fetch_assoc($img);
    if ($delete && !empty($rowimg['image'])){
        $old_picture_path = "assets/img/" . $rowimg['image'];
        if(file_exists($old_picture_path)){
            unlink($old_picture_path);
        }
    }
    $delete = mysqli_query ($conn, "DELETE FROM sliders WHERE id='$delete'");
    header("location:app.php?page=slider&hapus=berhasil");
}
?>

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3">Slider</h3>
    <h6 class="op-7 mb-2">Add your image information for homepage</h6>
    </div>
    <div class="ms-md-auto py-2 py-md-0">
        <a href="app.php?page=create-slider" class="btn btn-primary btn-round">Create New Slide</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped text-center" id="myTable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Text Button 1</th>
                        <th>Link Button 1</th>
                        <th>Text Button 2</th>
                        <th>Link Button 2</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        <?php foreach($rows as $index => $row):?>
                        <tr>
                            <td><?php echo $index + 1?></td>
                            <td><?php echo $row['title'];?></td>
                            <td><?php echo $row['subtitle'];?></td>
                            <td><?php echo $row['button1_text'];?></td>
                            <td><?php echo $row['button1_link'];?></td>
                            <td><?php echo $row['button2_text'];?></td>
                            <td><?php echo $row['button2_link'];?></td>
                            <td>
                                <img src="assets/img/<?php echo $row['image'] ?>" width="176" class="shadow" alt="img.jpg">
                            </td>
                            <td><?php echo $row['description'];?></td>
                            <td><?php echo $row['is_active'];?></td>
                            <td>
                                <a href="app.php?page=create-slider&edit=<?php echo $row['id']?>" class="btn btn-success btn-sm">Edit</a>
                                <a onclick="return confirm('Are you sure want to delete this data?')" href="app.php?page=slider&delete=<?php echo $row['id']?>" class="btn btn-danger btn-sm">Delete</a>
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