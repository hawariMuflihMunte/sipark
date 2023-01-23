<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>

<!-- View -->

<?php require('./template/header.php') ?>
<?php require('./template/navigation.php') ?>

    <main>
        <h3>Kendaraan Keluar</h3>
        <hr>
        <?php if (isset($_REQUEST['check'])): ?>
            <a href="./<?= $currentPage ?>" class="btn btn-outline-secondary btn-sm mb-4"><i class="bi bi-backspace-fill"></i> Kembali</a>
            <div class="border border-1 p-3 bg-light" style="max-width: 500px; overflow-y: auto;">
                <?php
                
                    $nomor_polisi = mysqli_real_escape_string($connection, trim($_REQUEST['nomor_polisi']));

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
                        nomor_polisi = '$nomor_polisi' AND
                        waktu_keluar IS NULL
                    ;";
                    $query = mysqli_query($connection, $SQL);
                
                ?>
                <?php if (mysqli_num_rows($query) > 0): ?>
                    <?php list(
                        $id,
                        $jenis_kendaraan,
                        $nomor_polisi_,
                        $waktu_masuk,
                        $waktu_keluar,
                        $biaya,
                        $petugas
                    ) = mysqli_fetch_array($query); ?>
                    <form action="./veh.out.add.php" method="post" id="out-vehicle">
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Jenis Kendaraan</span>
                            <input
                                type="text"
                                name="jenis_kendaraan"
                                id="jenis_kendaraan"
                                required
                                value="<?= $jenis_kendaraan ?>"
                                class="form-control "
                                readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Nomor Polisi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input
                                type="text"
                                name="nomor_polisi"
                                id="nomor_polisi"
                                required
                                value="<?= $nomor_polisi ?>"
                                class="form-control"
                                readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Waktu Masuk&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input
                                type="text"
                                name="waktu_masuk"
                                id="waktu_masuk"
                                required
                                value="<?= $waktu_masuk ?>"
                                class="form-control"
                                readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Waktu Keluar&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input
                                type="text"
                                name="waktu_keluar"
                                id="waktu_keluar"
                                required
                                <?php date_default_timezone_set("Asia/Jakarta") ?>
                                value="<?= date("Y-m-d H:i:s", time()) ?>"
                                class="form-control"
                                readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Biaya&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <span class="input-group-text">Rp</span>
                            <input
                                type="text"
                                name="biaya"
                                id="biaya"
                                required
                                value="<?= $biaya ?>"
                                class="form-control"
                                readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Petugas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input
                                type="text"
                                name="petugas"
                                id="petugas"
                                required
                                value="<?= $petugas ?>"
                                class="form-control"
                                readonly>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span></span>
                            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-check-lg"></i></button>
                        </div>
                        <script defer>
                            const outVehicle = document.getElementById('out-vehicle')

                            outVehicle.addEventListener('submit', (event) => {
                                event.returnValue = false

                                Swal.fire({
                                    text: "Yakin ingin mengeluarkan kendaraan ?",
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'Ya',
                                    cancelButtonColor: '#3085d6',
                                    cancelButtonText: 'Tidak'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        outVehicle.submit()
                                    }
                                })
                            })
                        </script>
                    </form>
                <?php else: ?>
                    <p>Data kendaraan tidak ditemukan</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="border border-1 p-3 bg-light mb-3">
                <form action="" method="post">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Nomor Polisi</span>
                        <input
                            type="text"
                            name="nomor_polisi"
                            id="nomor_polisi"
                            class="form-control"
                            required
                            value="<?= isset($_REQUEST['nomor_polisi']) ? $_REQUEST['nomor_polisi'] : '' ?>">
                        <button type="reset" class="btn btn-outline-secondary"><i class="bi bi-x-circle"></i></button>
                        <button type="submit" name="check" class="btn btn-success"><i class="bi bi-clipboard-check"></i></button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </main>

<?php require('./template/footer.php') ?>

<!-- View -->