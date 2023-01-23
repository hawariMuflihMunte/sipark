<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>

<!-- View -->

<?php if (!isset($_SESSION['role'])): ?>
    <?php
        header("location: ./index.php");
        exit();
    ?>
<?php else: ?>

    <?php
        
        $bulan = "";

        switch (date('m')) {
            case '01':
                $bulan = "Januari";
                break;
            case '02':
                $bulan = "Februari";
                break;
            case '03':
                $bulan = "Maret";
                break;
            case '04':
                $bulan = "April";
                break;
            case '05':
                $bulan = "Mei";
                break;
            case '06':
                $bulan = "Juni";
                break;
            case '07':
                $bulan = "Juli";
                break;
            case '08':
                $bulan = "Agustus";
                break;
            case '09':
                $bulan = "September";
                break;
            case '10':
                $bulan = "Oktober";
                break;
            case '11':
                $bulan = "November";
                break;
            case '12':
                $bulan = "Desember";
                break;
        }
    
    ?>

    <?php if ($_SESSION['role'] == 0): // Admin ?>
        <?php require('./template/header.php') ?>
        <?php require('./template/navigation.php') ?>

        <main>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $bulan ?></h5>
                    <hr>
                    <p class="card-text">
                        <div class="d-flex justify-content-between fs-5">
                            <?php

                                $tahun = date('Y');
                                $bulan = date('m');
                            
                                $SQL = "SELECT
                                    COUNT(*)
                                FROM
                                    kendaraan
                                WHERE
                                    waktu_keluar IS NULL AND
                                    waktu_masuk BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-31'
                                ;";
                                $query = mysqli_query($connection, $SQL);
                                $veh_in = mysqli_fetch_array($query)[0];
                            
                            ?>
                            <span class="text-success"><i class="bi bi-box-arrow-in-right"></i>&nbsp;<?= $veh_in ?></span>

                            <?php

                                $tahun = date('Y');
                                $bulan = date('m');
                            
                                $SQL = "SELECT
                                    COUNT(*)
                                FROM
                                    kendaraan
                                WHERE
                                    waktu_keluar IS NOT NULL AND
                                    waktu_masuk BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-31' OR
                                    waktu_keluar BETWEEN '$tahun-$bulan-01' AND '$tahun-$bulan-31'
                                ;";
                                $query = mysqli_query($connection, $SQL);
                                $veh_out = mysqli_fetch_array($query)[0];
                            
                            ?>
                            <span class="text-danger"><?= $veh_out ?>&nbsp;<i class="bi bi-box-arrow-right"></i></span>
                        </div>
                    </p>
                    <hr>
                    <a href="./veh.report.php" class="card-link">Rincian</a>
                </div>
            </div>
        </main>

        <?php require('./template/footer.php') ?>
    <?php else: // Petugas ?>
        <?php require('./template/header.php') ?>
        <?php require('./template/navigation.php') ?>

        <?php date_default_timezone_set("Asia/Jakarta"); ?>

        <main>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php

                            $hari = date('D');

                            switch($hari) {
                                case 'Mon':
                                    echo 'Senin';
                                    break;
                                case 'Tue':
                                    echo 'Selasa';
                                    break;
                                case 'Wed':
                                    echo 'Rabu';
                                    break;
                                case 'Thu':
                                    echo 'Kamis';
                                    break;
                                case 'Fri':
                                    echo 'Jumat';
                                    break;
                                case 'Sat':
                                    echo 'Sabtu';
                                    break;
                                case 'Sun':
                                    echo 'Minggu';
                                    break;
                            }

                        ?>
                    </h5>
                    <hr>
                    <p class="card-text">
                        <div class="d-flex justify-content-between fs-5">
                            <?php

                                $tahun = date('Y');
                                $bulan = date('m');
                                $tanggal = date('d');

                                $SQL = "SELECT
                                    COUNT(*)
                                FROM
                                    kendaraan
                                WHERE
                                    waktu_keluar IS NULL AND
                                    waktu_masuk BETWEEN '$tahun-$bulan-$tanggal 00:00:00' AND '$tahun-$bulan-$tanggal 23:59:59'
                                ;";
                                $query = mysqli_query($connection, $SQL);
                                $veh_in = mysqli_fetch_array($query)[0];
                            
                            ?>
                            <span class="text-success"><i class="bi bi-box-arrow-in-right"></i>&nbsp;<?= $veh_in ?></span>

                            <?php

                                $tahun = date('Y');
                                $bulan = date('m');
                                $tanggal = date('d');

                                $SQL = "SELECT
                                    COUNT(*)
                                FROM
                                    kendaraan
                                WHERE
                                    waktu_keluar IS NOT NULL AND
                                    waktu_masuk BETWEEN '$tahun-$bulan-$tanggal 00:00:00' AND '$tahun-$bulan-$tanggal 23:59:59' OR
                                    waktu_keluar BETWEEN '$tahun-$bulan-$tanggal 00:00:00' AND '$tahun-$bulan-$tanggal 23:59:59'
                                ;";
                                $query = mysqli_query($connection, $SQL);
                                $veh_out = mysqli_fetch_array($query)[0];
                            
                            ?>
                            <span class="text-danger"><?= $veh_out ?>&nbsp;<i class="bi bi-box-arrow-right"></i></span>
                        </div>
                    </p>
                    <hr>
                    <a href="./veh.report.php" class="card-link">Rincian</a>
                </div>
            </div>
        </main>

        <?php require('./template/footer.php') ?>
    <?php endif; ?>
<?php endif; ?>

<!-- View -->