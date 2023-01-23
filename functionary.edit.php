<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>
<?php require('./template/header.php') ?>

<?php

$id = $_REQUEST['id'];

$nama = mysqli_real_escape_string($connection, trim($_REQUEST['nama']));
$username = mysqli_real_escape_string($connection, trim($_REQUEST['username']));

$SQL = "UPDATE
    data_user
SET
    nama_lengkap = '$nama',
    username = '$username'
WHERE
    id = $id
;";
$query = mysqli_query($connection, $SQL);

if ($query) { // success
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Berhasil mengubah data petugas',
            confirmButtonText: 'OK',
        }).then((result) => {
            window.location.href = './functionary.php'
        })
    </script>";
} else { // error
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Gagal mengubah data petugas. Terjadi kesalahan sistem',
            confirmButtonText: 'OK',
        }).then((result) => {
            window.location.href = './functionary.php'
        })
    </script>";
}

?>

<?php require('./template/footer.php') ?>