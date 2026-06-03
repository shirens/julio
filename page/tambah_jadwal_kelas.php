<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal Kelas</h1>
                </div>
            </div>
        </div>
    </div>
    <?php
    //kode otomatis
    $carikode = mysqli_query($koneksi,"select max(id_jadwal) from jadwal_kelas") or die (
        mysqli_error());
    $datakode = mysqli_fetch_array($carikode);

if (!empty($datakode[0])) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int)$nilaikode + 1;
    $hasilkode = "0-" . str_pad($kode, 5, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "01";
}

    if(isset($_POST['tambah'])) {
        $id_jadwal = $_POST['id_jadwal'];
        $id_kelas = $_POST['id_kelas'];
        $thn_ajaran = $_POST['thn_ajaran'];
        $semester = $_POST['semester'];

        $insert = mysqli_query($koneksi,"INSERT INTO jadwal_kelas values ('$id_jadwal','$id_kelas','$thn_ajaran','$semester')");
        if($insert) {
            echo '<div class="alert alert-info-dismissible">
            <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">X</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4></div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal_kelas">';
        }else{
            echo 'div class="alert alert-warning alert-dismissible">
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
                        <form method="POST" action="">
                        <div class="form-group">
                            <label for="id_jadwal">Id Jadwal</label>
                            <input type="text" name="id_jadwal" value="<?= $hasilkode ; ?>"
                            placeholder="Id Kat" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_kelas">Id Kelas</label>
                            <input type="text" name="id_kelas" id="id_kelas"
                            placeholder="Id Kelas" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="thn_ajaran">Tahun Ajaran</label>
                            <input type="text" name="thn_ajaran" id="thn_ajaran"
                            placeholder="thn_ajaran" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" name="semester" id="semester"
                            placeholder="semester" class="form-control">
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" 
                            name="tambah" value="simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>