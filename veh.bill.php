<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>

<!-- View -->

<?php require('./template/header.php') ?>
<?php require('./template/navigation.php') ?>

<?php

    if (isset($_REQUEST['jenis_kendaraan']) && isset($_REQUEST['biaya'])) {
        $jenis_kendaraan = mysqli_real_escape_string($connection, trim($_REQUEST['jenis_kendaraan']));
        $biaya = mysqli_real_escape_string($connection, trim($_REQUEST['biaya']));

        $SQL = "UPDATE
            tagihan
        SET
            biaya_parkir = $biaya
        WHERE
            jenis_kendaraan = '$jenis_kendaraan'
        ;";
        $query = mysqli_query($connection, $SQL);

        if ($query) { // success
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Berhasil mengubah biaya parkir',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    window.location.href = './$currentPage'
                })
            </script>";
        } else { // error
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal mengubah biaya parkir. Terjadi kesalahan sistem',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    window.location.href = './$currentPage'
                })
            </script>";
        }
    }

?>

<main>
    <h3>Biaya Parkir</h3>
    <hr>
    <div class="row">
        <?php

            $SQL = "SELECT
                *
            FROM
                tagihan
            GROUP BY
                biaya_parkir
            ASC
            ;";
            $query = mysqli_query($connection, $SQL);

        ?>
        <?php if (mysqli_num_rows($query) > 0): ?>
            <div class="table-responsive custom-height-print">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis Kendaraan</th>
                            <th>Biaya Parkir</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php while (list(
                            $id,
                            $jenis_kendaraan,
                            $biaya
                        ) = mysqli_fetch_array($query)): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= ucfirst($jenis_kendaraan) ?></td>
                                <td>Rp<?= $biaya ?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-<?= $id ?>"><i class="bi bi-pen-fill"></i></a>
                                </td>
                            </tr>

                            <!-- Edit data -->
                            <div class="modal fade" id="edit-<?= $id ?>" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editLabel">Ubah Data Petugas <i class="bi bi-file-earmark-person-fill"></i></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post" class="edit">
                                            <input type="hidden" name="id" value="<?= $id ?>">
                                            <div class="modal-body">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Jenis Kendaraan</span>
                                                    <input
                                                        type="text"
                                                        name="jenis_kendaraan"
                                                        id="jenis_kendaraan"
                                                        class="form-control"
                                                        required
                                                        value="<?= ucfirst($jenis_kendaraan) ?>"
                                                        readonly>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Biaya&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                    <span class="input-group-text">Rp</span>
                                                    <input
                                                        type="number"
                                                        name="biaya"
                                                        id="biaya"
                                                        class="form-control"
                                                        required
                                                        min="2000"
                                                        value="<?= $biaya ?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-warning">Ubah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit data -->

                            <?php $i++; ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>
            <!-- NONE -->
        <?php endif; ?>
    </div>
</main>

<script>
    const editOptionForm = document.getElementsByClassName('edit')

    for (const edit_ of editOptionForm) {
        edit_.addEventListener('submit', (event) => {
            event.returnValue = false

            Swal.fire({
                title: 'Ubah?',
                text: "Apakah kamu yakin ingin mengubah data petugas ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    edit_.submit()
                }
            })
        })
    }
</script>

<?php require('./template/footer.php') ?>

<!-- View -->