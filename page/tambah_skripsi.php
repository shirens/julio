<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Skripsi</h1>
                </div>
            </div>
        </div>
    </div>
    <?php
    //kode otomatis
    $carikode = mysqli_query($koneksi,"select max(id_skripsi076) from skripsi_2511500076") or die (
        mysqli_error());
    $datakode = mysqli_fetch_array($carikode);

if (!empty($datakode[0])) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int)$nilaikode + 1;
    $hasilkode = "0" . str_pad($kode, 1, "1", STR_PAD_LEFT);
} else {
    $hasilkode = "2";
}

    if(isset($_POST['tambah'])) {
        $id_skripsi076 = $_POST['id_skripsi076'];
        $judul_skripsi076 = $_POST['judul_skripsi076'];
        $semester076 = $_POST['semester076'];
        $thn_ajaran076 = $_POST['thn_ajaran076'];

        $insert = mysqli_query($koneksi,"INSERT INTO skripsi_2511500076 values ('$id_skripsi076','$judul_skripsi076','$semester076','$thn_ajaran076')");
        if($insert) {
            echo '<div class="alert alert-info-dismissible">
            <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">X</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4></div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi">';
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
                            <label for="id_skripsi076">Id Skripsi</label>
                            <input type="text" name="id_skripsi076" value="<?= $hasilkode ; ?>"
                            placeholder="Id Skripsi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="judul_skripsi076">Judul Skripsi</label>
                            <input type="text" name="judul_skripsi076" id="judul_skripsi076"
                            placeholder="Judul Skripsi" class="form-control">
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
                            <input type="submit" class="btn btn-primary" 
                            name="tambah" value="simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>