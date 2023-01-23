<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>

<!-- View -->

<?php require('./template/header.php') ?>
<?php require('./template/navigation.php') ?>

    <main>
        <style>
            table th {
                font-weight: 500;
            }
        </style>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $_SESSION['name'] ?></td>
                        <td><?= $_SESSION['username'] ?></td>
                        <td><?= $_SESSION['role'] == 0 ? 'Administrator' : 'Petugas' ?></td>
                        <td class="text-center">
                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#password">
                                <i class="bi bi-key-fill"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit">
                                <i class="bi bi-person-fill-gear"></i>
                            </a>
                            <a href="./logout.php" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah kamu yakin ingin keluar ?')">
                                <i class="bi bi-box-arrow-left"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Edit data -->
            <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editLabel">Ubah Data Petugas <i class="bi bi-file-earmark-person-fill"></i></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="./profile.edit.php" method="post" onsubmit="return confirm('Apakah kamu yakin ingin mengubah data profil kamu ? ?')">
                            <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <input
                                        type="text"
                                        name="nama_lengkap"
                                        id="nama_lengkap"
                                        class="form-control"
                                        required
                                        value="<?= $_SESSION['name'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Username</span>
                                    <input
                                        type="text"
                                        name="username"
                                        id="username"
                                        class="form-control"
                                        required
                                        value="<?= $_SESSION['username'] ?>">
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

            <!-- Edit data [password] -->
            <div class="modal fade" id="password" tabindex="-1" aria-labelledby="passwordLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="passwordLabel">Ganti password <i class="bi bi-file-earmark-person-fill"></i></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="./profile.changepw.php" method="post" onsubmit="return confirm('Apakah kamu yakin ingin mengubah password kamu ?')">
                            <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Password Lama</span>
                                    <input
                                        type="password"
                                        name="password_lama"
                                        id="password_lama"
                                        class="form-control"
                                        required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Password Baru&nbsp;</span>
                                    <input
                                        type="password"
                                        name="password_baru"
                                        id="password_baru"
                                        class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-warning" >Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit data [password] -->

        </div>
    </main>

<?php require('./template/footer.php') ?>

<!-- View -->