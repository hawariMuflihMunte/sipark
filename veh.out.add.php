<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>
<?php require('./template/header.php') ?>

<?php

    $jenis_kendaraan = mysqli_real_escape_string($connection, trim($_REQUEST['jenis_kendaraan']));
    $nomor_polisi = mysqli_real_escape_string($connection, trim($_REQUEST['nomor_polisi']));
    $waktu_masuk = mysqli_real_escape_string($connection, trim($_REQUEST['waktu_masuk']));
    $waktu_keluar = mysqli_real_escape_string($connection, trim($_REQUEST['waktu_keluar']));
    $petugas = mysqli_real_escape_string($connection, trim($_REQUEST['petugas']));

    $SQL = "UPDATE
        kendaraan
    SET
        waktu_keluar = NOW()
    WHERE
        jenis_kendaraan = '$jenis_kendaraan' AND
        nomor_polisi = '$nomor_polisi'
    ;";
    $query = mysqli_query($connection, $SQL);

    if ($query) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                confirmButtonText: 'OK',
            }).then((result) => {
                window.location.href = './veh.out.php'
            })
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan sistem',
                confirmButtonText: 'OK',
            }).then((result) => {
                window.location.href = './veh.out.php'
            })
        </script>";
    }

?>

<?php require('./template/footer.php') ?>