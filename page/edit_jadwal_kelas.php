<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Jadwal Kelas</h1>
            </div>
        </div>
    </div>
</div>
    <?php
    $kd = $_GET['kd'];
    $edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT 
    * FROM jadwal_kelas WHERE id_jadwal= '$kd'"));

    if(isset($_POST['tambah'])){
        $id_jadwal = $_POST['id_jadwal'];
        $id_kelas = $_POST['id_kelas'];
        $thn_ajaran = $_POST['thn_ajaran'];
        $semester = $_POST['semester'];

        $insert = mysqli_query($koneksi,"UPDATE jadwal_kelas SET id_kelas='$id_kelas',
        thn_ajaran='$thn_ajaran', semester='$semester' WHERE id_jadwal='$id_jadwal' ");
        if ($insert) {
            echo '<div class="alert alert-info-dismissible">
            <button type="button" class="close" data-dismiss="alert" 
            aria-hidden="true">X</button>
            <h5> <i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4></div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal_kelas">';           
        }else{
           echo '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" 
            aria-hidden="true">X</button>
            <h5> <i class="icon fas fa-info"></i> Info </h5>
            <h4>Gagal Disimpan</h4></div>';
        }
    }
    ?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-body p-2">
                    <form method="POST" actions="">
                        <div class="form-group">
    <label for="id_jadwal">Id Jadwal</label>
    <input type="text" name="id_jadwal" value="<?= $edit['id_jadwal']; ?>" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="id_kelas">Id Kelas</label>
    <input type="text" name="id_kelas" value="<?= $edit['id_kelas']; ?>" id="id_kelas" placeholder="Id Kelas" class="form-control">
</div>

<div class="form-group">
    <label for="thn_ajaran">Tahun Ajaran</label>
    <input type="text" name="thn_ajaran" value="<?= $edit['thn_ajaran']; ?>" id="thn_ajaran" placeholder="Tahun Ajaran" class="form-control">
</div>

<div class="form-group">
    <label for="semester">Semester</label>
    <input type="text" name="semester" value="<?= $edit['semester']; ?>" id="semester" placeholder="Semester" class="form-control">
</div>

<div class="card-footer">
    <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
</div>
</form>
</div>
</div>
</div>
</section>