<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>
<?php require('./template/header.php') ?>


<?php


    $id = $_REQUEST['id'];
    $nama_lengkap = mysqli_real_escape_string($connection, trim($_REQUEST['nama_lengkap']));
    $username = mysqli_real_escape_string($connection, trim($_REQUEST['username']));

    $SQL = "UPDATE
        data_user
    SET
        nama_lengkap = '$nama_lengkap',
        username = '$username'
    WHERE
        id = $id
    ;";
    $query = mysqli_query($connection, $SQL);

    if ($query) {

        $_SESSION['name'] = $nama_lengkap;
        $_SESSION['username'] = $username;

        echo "<script>
            window.alert('Berhasil mengubah data')
            window.location.href = './profile.php'
        </script>";
        exit();

    } else {

        echo "<script>
            window.alert('Gagal mengganti data. Terjadi kesalahan sistem')
            window.location.href = './profile.php'
        </script>";
        exit();

    }


?>


<?php require('./template/footer.php') ?>