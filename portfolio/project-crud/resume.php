<?php
//tampil semua data dari user
$query = mysqli_query($conn, "SELECT * FROM resume ORDER BY id DESC");
$rows  = mysqli_fetch_all($query, MYSQLI_ASSOC);

//jika params delete ada
if (isset($_GET['delete'])){
    $delete = $_GET ['delete'];
    $delete = mysqli_query ($conn, "DELETE FROM resume WHERE id='$delete'");
    header("location:app.php?page=resume&hapus=berhasil");
}
?>

<div
    class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3">Resume</h3>
        <h6 class="op-7 mb-2">Educational Background Information</h6>
    </div>
    <div class="ms-md-auto py-2 py-md-0">
        <a href="app.php?page=create-resume" class="btn btn-primary btn-round">Create New Resume</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped text-center" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Institution</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Description</th>
                            <th>ACTION</th>
                        </tr>
                        <tbody>
                            <?php foreach($rows as $index => $row):?>
                            <tr>
                                <td><?php echo $index + 1?></td>
                                <td><?php echo $row['title'];?></td>
                                <td><?php echo $row['subtitle'];?></td>
                                <td><?php echo $row['year_start'];?></td>
                                <td><?php echo $row['year_end'];?></td>
                                <td><?php echo $row['description'];?></td>
                                <td>
                                    <a href="app.php?page=create-resume&edit=<?php echo $row['id']?>" class="btn btn-success btn-sm">Edit</a>
                                    <a onclick="return confirm('Are you sure want to delete this data?')" href="app.php?page=resume&delete=<?php echo $row['id']?>" class="btn btn-danger btn-sm">Delete</a>
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