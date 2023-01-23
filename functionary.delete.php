<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>
<?php require('./template/header.php') ?>

<?php

$id = $_GET['id'];

$SQL = "DELETE
FROM
    data_user
WHERE
    id = $id
;";
$query = mysqli_query($connection, $SQL);

if ($query) { // success
    echo "<script defer>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Berhasil menghapus data petugas',
            confirmButtonText: 'OK',
        }).then((result) => {
            window.location.href = './functionary.php'
        })
    </script>";
} else { // error
    echo "<script defer>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Gagal menghapus data petugas. Terjadi kesalahan sistem',
            confirmButtonText: 'OK',
        }).then((result) => {
            window.location.href = './functionary.php'
        })
    </script>";
}

?>

<?php require('./template/footer.php') ?>