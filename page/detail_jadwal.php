<?php
if (isset($_GET['hapus'])) {
    $id_jadwal = $_GET['hapus'];

    // hapus detail jadwal dulu
    mysqli_query($koneksi, "DELETE FROM detail_jadwal WHERE id_jadwal = '$id_jadwal'");

    // Lalu hapus jadwal
    $hapus = mysqli_query($koneksi, "DELETE FROM jadwal_kelas WHERE id_jadwal = '$id_jadwal'");

    if ($hapus) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> Data jadwal telah dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> Tidak dapat menghapus data.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm">
                    Tambah Jadwal
                </a>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Detail Jadwal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM jadwal_kelas");

                        if (!$query) {
                            die("Query Error: " . mysqli_error($koneksi));
                        }

                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['thn_ajaran']}</td>
                                <td>{$row['semester']}</td>
                                <td>
                                    <ul>";

                            $det = mysqli_query($koneksi, "SELECT d.*, m.nm_mapel, g.nm_guru 
                                    FROM detail_jadwal d
                                    JOIN mapel m ON d.kd_mapel = m.kd_mapel
                                    JOIN guru g ON d.kd_guru = g.kd_guru
                                    WHERE d.id_jadwal = '{$row['id_jadwal']}'");

                            while ($d = mysqli_fetch_assoc($det)) {
                                echo "<li>{$d['nm_mapel']} - {$d['nm_guru']} ({$d['hari']}, {$d['jam_mulai']}-{$d['jam_selesai']}, {$d['nm_kelas']})</li>";
                            }

                            echo "</ul>
                                </td>
                                <td>
                                    <a href='index.php?page=detail_jadwal&hapus={$row['id_jadwal']}'
                                    onclick=\"return confirm('Yakin ingin menghapus data ini?')\"
                                    class='btn btn-danger btn-sm'>Hapus</a>
                                </td>
                            </tr>";

                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>