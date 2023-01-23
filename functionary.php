<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>

<!-- View -->

<?php require('./template/header.php') ?>
<?php require('./template/navigation.php') ?>

<?php

    if (isset($_REQUEST['add'])) {
        $nama = mysqli_real_escape_string($connection, trim($_REQUEST['nama']));
        $username = mysqli_real_escape_string($connection, trim($_REQUEST['username']));
        $password = mysqli_real_escape_string($connection, trim($_REQUEST['password']));

        $SQL = "INSERT INTO data_user (
            nama_lengkap,
            username,
            password
        )
        VALUES (
            '$nama',
            '$username',
            '$password'
        )
        ;";
        $query = mysqli_query($connection, $SQL);

        if ($query) { // success
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Berhasil menambahkan data petugas baru',
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
                    text: 'Gagal menambahkan data petugas baru. Terjadi kesalahan sistem',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    window.location.href = './$currentPage'
                })
            </script>";
        }
    }

?>

<main>
    <h3>Data Petugas</h3>
    <hr>
    <div class="d-flex mb-3">
        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#add">Tambah Petugas <i class="bi bi-file-earmark-person-fill"></i></a>

        <!-- Add data -->
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addLabel">Tambah Petugas <i class="bi bi-file-earmark-person-fill"></i></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Username</span>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Password&nbsp;</span>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="add" class="btn btn-warning">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add data -->
    </div>
    <div class="row">
        <?php

            $SQL = "SELECT
                *
            FROM
                data_user
            WHERE
                kode_status != 0
            ;";
            $query = mysqli_query($connection, $SQL);

        ?>
        <?php if (mysqli_num_rows($query) > 0): ?>
            <div class="table-responsive" style="max-height: 420px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Petugas</th>
                            <th>Username</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php while (list($id, $fullname, $username, $password, $role, $created, $login_history, $logout_history) = mysqli_fetch_array($query)): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $fullname ?></td>
                                <td><?= $username ?></td>
                                <td class="text-center">
                                    <!-- <a href="./functionary.edit.php?id=<?//= $id ?>" class="edit btn btn-warning btn-sm"><i class="bi bi-pen-fill"></i></a> -->
                                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-<?= $id ?>"><i class="bi bi-pen-fill"></i></a>
                                    <a href="./functionary.delete.php?id=<?= $id ?>" class="delete btn btn-danger btn-sm"><i class="bi bi-trash2"></i></a>
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
                                        <form action="./functionary.edit.php" method="post" class="edit">
                                            <input type="hidden" name="id" value="<?= $id ?>">
                                            <div class="modal-body">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                    <input
                                                        type="text"
                                                        name="nama"
                                                        id="nama"
                                                        class="form-control"
                                                        required
                                                        value="<?= $fullname ?>">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Username</span>
                                                    <input
                                                        type="text"
                                                        name="username"
                                                        id="username"
                                                        class="form-control"
                                                        required
                                                        value="<?= $username ?>">
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

    const deleteOption = document.getElementsByClassName('delete')

    for (let i = 0; i < deleteOption.length; i++) {
        deleteOption[i].addEventListener('click', (event) => {
            event.returnValue = false

            const link_ref = deleteOption[i].getAttribute('href')

            Swal.fire({
                title: 'Hapus?',
                text: "Apakah kamu yakin ingin menghapus data petugas ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `./${link_ref}`
                }
            })
        })
    }
</script>

<?php require('./template/footer.php') ?>

<!-- View -->