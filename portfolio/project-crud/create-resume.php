<?php
// Jika tombol simpan ditekan, maka data akan tersimpan
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($conn, "SELECT * FROM resume WHERE id ='$id'");
$row  = mysqli_fetch_assoc($query);

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $year_start = $_POST['year_start'];
    $year_end = $_POST['year_end'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];

    if($id){
        $update = mysqli_query($conn, "UPDATE resume SET title='$title', year_start='$year_start', year_end='$year_end', subtitle='$subtitle', description='$description' WHERE id='$id'");
        header("location:app.php?page=resume&update=berhasil");

    } else{
        $insert = mysqli_query($conn, "INSERT INTO resume (title, year_start, year_end, subtitle, description) VALUES ('$title', '$year_start', '$year_end', '$subtitle', '$description')");
        header("location:app.php?page=resume&tambah=berhasil");
    }
    
}
//tampil semua data dari user

?>

<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3"><?php echo isset($_GET['edit']) ? 'Edit Resume' : 'Create New Resume'?></h3>
        <h6 class="op-7 mb-2"><?php echo isset($_GET['edit']) ? 'Edit your educational background information' : 'Add your educational background information'?></h6>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Title</label>
                        <label for="">:</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required value="<?php echo ($id) ? $row['title'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Subtitle</label>
                        <label for="">:</label>
                        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Enter subtitle" required value="<?php echo ($id) ? $row['subtitle'] : ''?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Year Start</label>
                        <label for="">:</label><br>
                        <!-- <input type="number" class="form control w-25" name="year_start" id="year_start" placeholder="" required value="<?php //echo ($id) ? $row['year_start'] : ''?>">
                        <label for="" class="fw-bold"> <i class="fa fa-address-book"></i> ==> </label>
                        <input type="number" class="form control w-25" name="year_end" id="year_end" placeholder="" required value="<?php //echo ($id) ? $row['year_end'] : ''?>"> -->

                        <select name="year_start" id="year_start" class="form-select">
                            
                        </select><br>
                        <label for="" class="form-label fw-bold">Year End</label>
                        <label for="">:</label><br>
                        <select name="year_end" id="year_end" class="form-select">
                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Description</label>
                        <label for="">:</label>
                        <textarea class="form-control" name="description" id="description"><?php echo ($id) ? $row['description'] : ''?></textarea>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const year_start = document.getElementById("year_start");
    const year_end = document.getElementById("year_end");
    const year_old = 1920;
    const currentYear = new Date().getFullYear();

    const yearDataStart = "<?php echo ($id) ? $row['year_start'] : '' ?>";
    const yearDataEnd = "<?php echo ($id) ? $row['year_end'] : '' ?>";

    for (let year = currentYear; year >= year_old; year--) {
    const option = document.createElement("option");
    option.value = year;
    option.textContent = year;
    if (yearDataStart && yearDataStart == year) {
    option.selected = true;
    }
    year_start.appendChild(option);
    }
    for (let year = currentYear; year >= year_old; year--) {
    const option = document.createElement("option");
    option.value = year;
    option.textContent = year;
    if (yearDataEnd && yearDataEnd == year) {
    option.selected = true;
    }
    year_end.appendChild(option);
    }
    });
</script>