<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Skripsi</h1>
            </div>
        </div>
    </div>
</div>
    <?php
    $kd = $_GET['kd'];
    $edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT 
    * FROM skripsi_2511500076 WHERE id_skripsi076= '$kd'"));

    if(isset($_POST['tambah'])){
        $id_skripsi076 = $_POST['id_skripsi076'];
        $judul_skripsi076 = $_POST['judul_skripsi076'];
        $semester076 = $_POST['semester076'];
        $thn_ajaran076 = $_POST['thn_ajaran076'];

        $insert = mysqli_query($koneksi,"UPDATE skripsi_2511500076 SET judul_skripsi076='$judul_skripsi076',
        semester076='$semester076', thn_ajaran076='$thn_ajaran076' WHERE id_skripsi076='$id_skripsi076' ");
        if ($insert) {
            echo '<div class="alert alert-info-dismissible">
            <button type="button" class="close" data-dismiss="alert" 
            aria-hidden="true">X</button>
            <h5> <i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4></div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi_2511500076">';           
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
    <label for="id_skripsi076">Id Skripsi</label>
    <input type="text" name="id_skripsi076" value="<?= $edit['id_skripsi076']; ?>" class="form-control">
</div>

<div class="form-group">
    <label for="judul_skripsi076">Judul Skripsi</label>
    <input type="text" name="judul_skripsi076" value="<?= $edit['judul_skripsi076']; ?>" id="judul_skripsi076" placeholder="Judul Skripsi" class="form-control">
</div>

<div class="form-group">
                        <label for="semester076">Semester</label>
                        <select name="semester076" id="semester076" class="form-control" required>
                            <option value="">-- Pilih Semester --</option>
                            <option value="Laki-Laki">Genap</option>
                            <option value="Perempuan">Ganjil</option>
                        </select>
                    </div>
                        <div class="form-group">
                        <label for="thn_ajaran076">Tahun Ajaran</label>
                        <select name="thn_ajaran076" id="thn_ajaran076" class="form-control" required>
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            <option value="Laki-Laki">2024/2025</option>
                            <option value="Perempuan">2025/2026</option>
                        </select>
                    </div>

<div class="card-footer">
    <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
</div>
</form>
</div>
</div>
</div>
</section>