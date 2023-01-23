<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>

<!-- View -->

<?php require('./template/header.php') ?>
<?php require('./template/navigation.php') ?>

    <main>
        <h3 class="no-print">Kendaraan Masuk</h3>
        <hr class="no-print">
        <?php if (isset($_REQUEST['add'])): ?>
            <a href="./<?= $currentPage ?>" class="btn btn-outline-secondary btn-sm mb-4 no-print"><i class="bi bi-backspace-fill"></i> Kembali</a>
        <?php endif; ?>
        <div class="border border-1 p-3 bg-light">
            <?php if (!isset($_REQUEST['add'])): ?>
                <form action="" method="post">
                    <?php date_default_timezone_set("Asia/Jakarta"); ?>
                    <input type="hidden" name="id_petugas" value="<?= $_SESSION['id'] ?>">
                    <input type="hidden" name="waktu_masuk" value="<?= date("Y-m-d H:i:s", time()) ?>">
                    <select class="form-select mb-3" name="jenis_kendaraan" required>
                        <option selected disabled value="">-- Pilih jenis kendaraan --</option>
                        <option value="motor">Motor</option>
                        <option value="mobil">Mobil</option>
                    </select>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Nomor Polisi</span>
                        <input type="text" name="nomor_polisi" id="nomor_polisi" class="form-control" required>
                        <button type="reset" class="btn btn-outline-secondary"><i class="bi bi-x-circle"></i></button>
                        <button type="submit" name="add" class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </form>
            <?php else: ?>
                <?php require('./veh.in.card.php') ?>
            <?php endif; ?>
        </div>
    </main>

<?php require('./template/footer.php') ?>

<!-- View -->