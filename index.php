<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>

<!-- View -->

<?php require('./template/header.php') ?>

<div class="container mt-5 pt-5">
    <div class="card mx-auto" style="width: 22rem;">
        <div class="card-body">
            <div class="d-flex justify-content-center mb-4">
                <img src="./assets/image/SIPARK.png" alt="SIPARK" width="150" class="mx-auto">
            </div>
            <h6 class="card-subtitle mb-0 text-muted text-center">MASUK</h6>
            <form action="" method="post" autocomplete="off">
                <p class="card-text pt-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="username">@</span>
                        <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="username">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="kata_sandi"><i class="bi bi-person-fill-lock"></i></span>
                        <input type="password" name="kata_sandi" class="form-control" placeholder="Kata sandi" aria-label="Kata_sandi" aria-describedby="kata_sandi">
                    </div>
                </p>
                <div class="d-flex justify-content-between">
                    <span></span>
                    <button type="submit" name="login" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php

    if (isset($_REQUEST['login'])) {
        if (empty($_REQUEST['username']) && empty($_REQUEST['kata_sandi'])) {
            echo "<script>
                Swal.fire(
                    'Gagal',
                    'Username dan password kosong!',
                    'error'
                )
            </script>";
        }
        elseif (empty($_REQUEST['username'])) {
            echo "<script>
                Swal.fire(
                    'Gagal',
                    'Username kosong!',
                    'error'
                )
            </script>";
        }
        elseif (empty($_REQUEST['kata_sandi'])) {
            echo "<script>
                Swal.fire(
                    'Gagal',
                    'Password kosong!',
                    'error'
                )
            </script>";
        }
        elseif (!empty($_REQUEST['username']) && !empty($_REQUEST['kata_sandi'])) {
            $username = mysqli_real_escape_string($connection, trim($_REQUEST['username']));
            $password = mysqli_real_escape_string($connection, trim($_REQUEST['kata_sandi']));
    
            $SQL = "SELECT
                *
            FROM
                data_user
            WHERE
                username = '$username' AND
                password = '$password'
            ;";
            $query = mysqli_query($connection, $SQL);
    
            if (mysqli_num_rows($query) > 0) { // success
                list(
                    $id,
                    $nama_lengkap,
                    $username,
                    $kata_sandi,
                    $role
                ) = mysqli_fetch_array($query);

                
                $SQL = "UPDATE
                    data_user
                SET
                    riwayat_masuk = NOW()
                WHERE
                    id = $id
                ;";
                $query = mysqli_query($connection, $SQL);
    
                if ($query) {
                    $_SESSION['id'] = $id;
                    $_SESSION['name'] = $nama_lengkap;
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $kata_sandi;
                    $_SESSION['role'] = $role;
        
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Autentikasi Berhasil',
                            text: 'Kamu akan diarahkan ke aplikasi setelah klik OK',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            window.location.href = './page.php'
                        })
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire(
                            'Gagal',
                            'Pastikan username dan password benar!',
                            'error'
                        )
                    </script>";    
                }
            } else { // error
                echo "<script>
                    Swal.fire(
                        'Gagal',
                        'Pastikan username dan password benar!',
                        'error'
                    )
                </script>";
            }
        }
    }

?>

<?php require('./template/footer.php') ?>

<!-- View -->