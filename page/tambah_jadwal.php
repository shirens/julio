<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
$carikode = mysqli_query($koneksi, "SELECT MAX(id_jadwal) FROM jadwal_kelas") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if ($datakode && $datakode[0] != null) {
    $kode = (int) $datakode[0] + 1;
} else {
    $kode = 1;
}
$hasilkode = $kode; // id_jadwal int(11), auto increment-able tapi kita generate manual

$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {
    $id_kelas = $_POST['id_kelas'];
    $semester = $_POST['semester'];
    $tahun_ajaran = $_POST['tahun_ajaran'];

    $kd_mapel = $_POST['kd_mapel'];
    $kd_guru = $_POST['kd_guru'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $nm_kelas = $_POST['nm_kelas'];

    // Insert ke tabel jadwal_kelas (id_jadwal auto_increment, jadi tidak usah dimasukkan manual)
    mysqli_query($koneksi, "INSERT INTO jadwal_kelas (id_kelas, thn_ajaran, semester) 
                VALUES ('$id_kelas', '$tahun_ajaran', '$semester')")
        or die("Gagal insert ke tabel jadwal_kelas : " . mysqli_error($koneksi));

    // Ambil id_jadwal yang baru dibuat
    $id_jadwal = mysqli_insert_id($koneksi);

    // Insert ke detail_jadwal
    $allSuccess = true;

    for ($i = 0; $i < count($kd_mapel); $i++) {
        $insert = mysqli_query($koneksi, "INSERT INTO detail_jadwal (id_jadwal, kd_mapel, kd_guru, hari, jam_mulai, jam_selesai, nm_kelas)
                    VALUES ('$id_jadwal', '{$kd_mapel[$i]}', '{$kd_guru[$i]}', '{$hari[$i]}', '{$jam_mulai[$i]}', '{$jam_selesai[$i]}', '{$nm_kelas[$i]}')");

        if (!$insert) {
            $allSuccess = false;
            echo "Gagal insert detail ke-{$i}: " . mysqli_error($koneksi);
        }
    }

    if ($allSuccess) {
        echo '<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-info"></i> Info</h5>
                <b>Berhasil Disimpan!</b></div>';
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=jadwal_kelas'>";
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-info"></i> Info</h5>
                <h4>Gagal menyimpan sebagian atau seluruh data detail.</h4></div>';
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <h3>Tambah Jadwal</h3>

                <form method="POST" action="">

                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="id_kelas" class="form-control" required>
                            <option selected disabled>--Pilih Kelas--</option>
                            <?php
                            $kelas_q = mysqli_query($koneksi, "SELECT * FROM kelas");
                            while ($k = mysqli_fetch_assoc($kelas_q)) {
                                echo "<option value='{$k['id_kelas']}'>{$k['nm_kelas']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required>
                            <option selected disabled>--Pilih semester--</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select name="tahun_ajaran" class="form-control" required>
                            <option selected disabled>--Pilih Tahun Ajaran--</option>
                            <option>2024-2025</option>
                            <option>2025-2026</option>
                        </select>
                    </div>

                    <hr>

                    <h5>Detail Jadwal</h5>

                    <div id="detail-jadwal">
                        <div class="row mb-2">

                            <div class="col-md-2">
                                <select name="kd_mapel[]" class="form-control" required>
                                    <option selected disabled>--Pilih Mapel--</option>
                                    <?php
                                    $mapel = mysqli_query($koneksi, "SELECT * FROM mapel");
                                    while ($m = mysqli_fetch_assoc($mapel)) {
                                        echo "<option value='{$m['kd_mapel']}'>{$m['nm_mapel']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select name="kd_guru[]" class="form-control" required>
                                    <option selected disabled>--Pilih Guru--</option>
                                    <?php
                                    $guru = mysqli_query($koneksi, "SELECT * FROM guru");
                                    while ($g = mysqli_fetch_assoc($guru)) {
                                        echo "<option value='{$g['kd_guru']}'>{$g['nm_guru']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select name="hari[]" class="form-control" required>
                                    <option selected disabled>--Pilih Hari--</option>
                                    <option>Senin</option>
                                    <option>Selasa</option>
                                    <option>Rabu</option>
                                    <option>Kamis</option>
                                    <option>Jumat</option>
                                    <option>Sabtu</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <input type="time" name="jam_mulai[]" class="form-control" required>
                            </div>

                            <div class="col-md-2">
                                <input type="time" name="jam_selesai[]" class="form-control" required>
                            </div>

                            <div class="col-md-2">
                                <input type="text" name="nm_kelas[]" class="form-control" placeholder="Nama Kelas" required>
                            </div>

                        </div>
                    </div>

                    <button type="button" class="btn btn-info" onclick="tambahBaris()">
                        + Tambah Mapel
                    </button>

                    <br><br>

                    <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                </form>

                <script>
                function tambahBaris() {
                    let container = document.getElementById('detail-jadwal');
                    let row = container.firstElementChild.cloneNode(true);

                    row.querySelectorAll('input').forEach(input => input.value = '');
                    row.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

                    container.appendChild(row);
                }
                </script>

            </div>
        </div>
    </div>
</div>