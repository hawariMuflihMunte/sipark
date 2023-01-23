<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>

<!-- View -->

<?php require('./template/header.php') ?>
<?php require('./template/navigation.php') ?>

    <main>
        <h3 class="no-print">Laporan Parkir Kendaraan</h3>
        <hr class="no-print">
        <button type="button" onclick="window.print()" class="btn btn-info btn-sm no-print">
            <i class="bi bi-printer"></i>
        </button>
        <div class="d-flex align-items-center gap-4 mb-4">
            <img src="./assets/image/SIPARK.png" alt="SIPARK" width="60" class="no-screen">
            <span class="no-screen">SIPARK</span>
        </div>
        <?php
            $monday = strtotime('last monday', strtotime('tomorrow'));
            $sunday = strtotime('+6 days', $monday);
            // echo "<P>". date('d-F-Y', $monday) . " to " . date('d-F-Y', $sunday) . "</P>";
        ?>
        <?php if ($_SESSION['role'] == 0): ?>
        <form action="" method="post" class="no-print">
            <div class="input-group input-group-sm mb-2">
                <select class="form-select" name="bulan" id="bulan" required>
                    <option disabled value="">-- Filter bulan --</option>
                    <?php date_default_timezone_set("Asia/Jakarta") ?>
                    <?php if (!isset($_REQUEST['bulan'])): ?>
                        <option value="semua">Semua</option>
                        <option value="01" <?= date('m') == '01' ? 'selected' : '' ?>>Januari</option>
                        <option value="02" <?= date('m') == '02' ? 'selected' : '' ?>>Februari</option>
                        <option value="03" <?= date('m') == '03' ? 'selected' : '' ?>>Maret</option>
                        <option value="04" <?= date('m') == '04' ? 'selected' : '' ?>>April</option>
                        <option value="05" <?= date('m') == '05' ? 'selected' : '' ?>>Mei</option>
                        <option value="06" <?= date('m') == '06' ? 'selected' : '' ?>>Juni</option>
                        <option value="07" <?= date('m') == '07' ? 'selected' : '' ?>>Juli</option>
                        <option value="08" <?= date('m') == '08' ? 'selected' : '' ?>>Agustus</option>
                        <option value="09" <?= date('m') == '09' ? 'selected' : '' ?>>September</option>
                        <option value="10" <?= date('m') == '10' ? 'selected' : '' ?>>Oktober</option>
                        <option value="11" <?= date('m') == '11' ? 'selected' : '' ?>>November</option>
                        <option value="12" <?= date('m') == '12' ? 'selected' : '' ?>>Desember</option>
                    <?php else: ?>
                        <option value="semua" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == 'semua' ? 'selected' : '' ?>>Semua</option>
                        <option value="01" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '01' ? 'selected' : '' ?>>Januari</option>
                        <option value="02" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '02' ? 'selected' : '' ?>>Februari</option>
                        <option value="03" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '03' ? 'selected' : '' ?>>Maret</option>
                        <option value="04" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '04' ? 'selected' : '' ?>>April</option>
                        <option value="05" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '05' ? 'selected' : '' ?>>Mei</option>
                        <option value="06" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '06' ? 'selected' : '' ?>>Juni</option>
                        <option value="07" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '07' ? 'selected' : '' ?>>Juli</option>
                        <option value="08" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '08' ? 'selected' : '' ?>>Agustus</option>
                        <option value="09" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '09' ? 'selected' : '' ?>>September</option>
                        <option value="10" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '10' ? 'selected' : '' ?>>Oktober</option>
                        <option value="11" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '11' ? 'selected' : '' ?>>November</option>
                        <option value="12" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '12' ? 'selected' : '' ?>>Desember</option>
                    <?php endif; ?>
                </select>
                <select name="tahun" id="tahun" class="form-select" required>
                    <?php if (!isset($_REQUEST['tahun'])): ?>
                        <option value="<?= date("Y", strtotime("last year")) ?>" <?= date("Y") == date("Y") ? 'selected' : '' ?>><?= date("Y", strtotime("last year")) ?></option>
                        <option value="<?= date("Y") ?>" <?= date("Y") == date("Y") ? 'selected' : '' ?>><?= date("Y") ?></option>
                    <?php else: ?>
                        <option value="<?= date("Y", strtotime("last year")) ?>" <?= isset($_REQUEST['tahun']) && $_REQUEST['tahun'] == date("Y", strtotime("last year")) ? 'selected' : '' ?>><?= date("Y", strtotime("last year")) ?></option>
                        <option value="<?= date("Y") ?>" <?= isset($_REQUEST['tahun']) && $_REQUEST['tahun'] == date("Y") ? 'selected' : '' ?>><?= date("Y") ?></option>
                    <?php endif; ?>
                </select>
                <button type="submit" name="filter" class="btn btn-outline-success"><i class="bi bi-funnel"></i></button>
            </div>
        </form>
        <?php endif; ?>

        <?php require('./veh.report.output.php') ?>

    </main>

<?php require('./template/footer.php') ?>

<!-- View -->