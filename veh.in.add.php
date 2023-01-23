<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>
<?php require('./template/header.php') ?>

<?php

    $jenis_kendaraan = mysqli_real_escape_string($connection, trim(strtolower($_REQUEST['jenis_kendaraan'])));
    $nomor_polisi = mysqli_real_escape_string($connection, trim($_REQUEST['nomor_polisi']));
    $id_petugas = mysqli_real_escape_string($connection, trim($_REQUEST['id_petugas']));

    // Validasi
    $SQL = "SELECT
        *
    FROM
        kendaraan
    WHERE
        jenis_kendaraan = '$jenis_kendaraan' AND
        nomor_polisi = '$nomor_polisi' AND
        waktu_keluar IS NOT NULL
    ;";
    $query = mysqli_query($connection, $SQL);

    // Cek kendaraan sudah pernah masuk sebelumnya
    if (mysqli_num_rows($query) == 0) { // Kendaraan belum pernah masuk

        $SQL = "INSERT INTO kendaraan (
            jenis_kendaraan,
            nomor_polisi,
            id_petugas
        )
        VALUES (
            '$jenis_kendaraan',
            '$nomor_polisi',
            $id_petugas
        )
        ;";
        $query = mysqli_query($connection, $SQL);

        if ($query) { // success
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    window.location.href = './veh.in.php'
                })
            </script>";
        } else { // error
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    window.location.href = './veh.in.php'
                })
            </script>";
        }

    } else { // Kendaraan sudah pernah masuk

        $SQL = "UPDATE
            kendaraan
        SET
            waktu_masuk = NOW(),
            waktu_keluar = NULL,
            id_petugas = $id_petugas
        WHERE
            jenis_kendaraan = '$jenis_kendaraan' AND
            nomor_polisi = '$nomor_polisi'
        ;";
        $query = mysqli_query($connection, $SQL);
        
        if ($query) { // success

            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    window.location.href = './veh.in.php'
                })
            </script>";

        } else {

            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal memasukkan kendaraan. Terjadi kesalahan sistem',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    window.location.href = './veh.in.php'
                })
            </script>";

        }

    }

?>

<?php require('./template/footer.php') ?>