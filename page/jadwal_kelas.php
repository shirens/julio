<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Detail Jadwal</h1>
            </div>
        </div>
    </div>
</div>

 <?php
if(isset($_GET['action'])) {
    if($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];
        $query = mysqli_query($koneksi, "DELETE FROM jadwal_kelas where id_jadwal = '$kd' ");
        if ($query){
            echo '
            <div class="alert alert-warning alert-dismissible">
            Berhasil Di Hapus</div>';
            echo '<meta http-equiv"refresh" content="1;url=index.php?page=jadwal_kelas">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <a href="index.php?page=tambah_jadwal_kelas" class="btn btn-primary btn-sm">
                Tambah Jadwal
            </a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Id Jadwal</th>
                        <th>Id Kelas</th>
                        <th>Tahun Ajaran</th>
                         <th>Semester</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php
                $no = 0;
                $query = mysqli_query($koneksi,"SELECT * FROM jadwal_kelas");
                while ($result = mysqli_fetch_array($query)) {
                    $no++;
                ?>
                <tbody>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $result['id_jadwal']; ?></td>
                        <td><?= $result['id_kelas']; ?></td>
                        <td><?= $result['thn_ajaran']; ?></td>
                        <td><?= $result['semester']; ?></td>
                        <td>
                            <a href="index.php?page=jadwal_kelas&action=hapus&kd=<?= $result['id_jadwal'] ?>">
                                <span class="badge badge-danger">Hapus</span>
                            </a>
                            <a href="index.php?page=edit_jadwal_kelas&kd=<?= $result['id_jadwal'] ?>" title="">
                                <span class="badge badge-warning">Edit</span>
                            </a>
                        </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>