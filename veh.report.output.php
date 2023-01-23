<?php require('./functions/session.php') ?>
<?php date_default_timezone_set("Asia/Jakarta"); ?>

<?php

    if (isset($_REQUEST['filter'])) {
        $bulan = $_REQUEST['bulan'];
        $tahun = $_REQUEST['tahun'];

        if ($bulan == 'semua') {

            $SQL = "SELECT
                k.id id,
                k.jenis_kendaraan jenis_kendaraan,
                k.nomor_polisi nomor_polisi,
                k.waktu_masuk waktu_masuk,
                k.waktu_keluar waktu_keluar,
                t.biaya_parkir biaya_parkir,
                u.nama_lengkap nama_lengkap
            FROM
                kendaraan k
            JOIN data_user u ON
                u.id = k.id_petugas
            JOIN tagihan t ON
                t.jenis_kendaraan = k.jenis_kendaraan
            WHERE
                k.waktu_masuk BETWEEN '$tahun-01-01' AND '$tahun-12-31' OR
                k.waktu_keluar BETWEEN '$tahun-01-01' AND '$tahun-12-31'
            ;";
            $_SESSION['query_report'] = $SQL;

        }
        else {

            $SQL = "SELECT
                k.id id,
                k.jenis_kendaraan jenis_kendaraan,
                k.nomor_polisi nomor_polisi,
                k.waktu_masuk waktu_masuk,
                k.waktu_keluar waktu_keluar,
                t.biaya_parkir biaya_parkir,
                u.nama_lengkap nama_lengkap
            FROM
                kendaraan k
            JOIN data_user u ON
                u.id = k.id_petugas
            JOIN tagihan t ON
                t.jenis_kendaraan = k.jenis_kendaraan
            WHERE
                k.waktu_masuk BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-31' OR
                k.waktu_keluar BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-31'
            ;";
            $_SESSION['query_report'] = $SQL;

        }
    }

?>

<?php if (!isset($_REQUEST['filter'])): ?>

    <?php
        
        date_default_timezone_set("Asia/Jakarta");
        $bulan_ = date("m");
        $tahun_ = date("Y");
        $tanggal_ = date("d");

        $SQL = "SELECT
            k.id id,
            k.jenis_kendaraan jenis_kendaraan,
            k.nomor_polisi nomor_polisi,
            k.waktu_masuk waktu_masuk,
            k.waktu_keluar waktu_keluar,
            t.biaya_parkir biaya_parkir,
            u.nama_lengkap nama_lengkap
        FROM
            kendaraan k
        JOIN data_user u ON
            u.id = k.id_petugas
        JOIN tagihan t ON
            t.jenis_kendaraan = k.jenis_kendaraan
        WHERE
            k.waktu_masuk BETWEEN '$tahun_-$bulan_-$tanggal_ 00:00:00' AND '$tahun_-$bulan_-$tanggal_ 23:59:59' OR
            k.waktu_keluar BETWEEN '$tahun_-$bulan_-$tanggal_ 00:00:00' AND '$tahun_-$bulan_-$tanggal_ 23:59:59'
        ;";
        $query = mysqli_query($connection, $SQL);

    ?>
    <div class="table-responsive custom-height-print">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jenis Kendaraan</th>
                    <th>Nomor Polisi</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Biaya</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($query) == 0): ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            -- Tidak ada laporan --
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $i = 1; ?>
                    <?php while(list(
                        $id,
                        $jenis_kendaraan,
                        $nomor_polisi,
                        $waktu_masuk,
                        $waktu_keluar,
                        $biaya,
                        $petugas
                    ) = mysqli_fetch_array($query)): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= ucwords($jenis_kendaraan) ?></td>
                            <td><?= $nomor_polisi ?></td>
                            <td><?= $waktu_masuk ?></td>
                            <td><?= empty($waktu_keluar) ? '-' : $waktu_keluar ?></td>
                            <td>Rp<?= $biaya ?></td>
                            <td><?= $petugas ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php else: ?>

    <?php
        
        date_default_timezone_set("Asia/Jakarta");
        $query = mysqli_query($connection, $_SESSION['query_report']);

    ?>
    <div class="table-responsive custom-height-print">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jenis Kendaraan</th>
                    <th>Nomor Polisi</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Biaya</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php while(list(
                    $id,
                    $jenis_kendaraan,
                    $nomor_polisi,
                    $waktu_masuk,
                    $waktu_keluar,
                    $biaya,
                    $petugas
                ) = mysqli_fetch_array($query)): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= ucwords($jenis_kendaraan) ?></td>
                        <td><?= $nomor_polisi ?></td>
                        <td><?= $waktu_masuk ?></td>
                        <td><?= empty($waktu_keluar) ? '-' : $waktu_keluar ?></td>
                        <td>Rp<?= $biaya ?></td>
                        <td><?= $petugas ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>