<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>
<?php require('./template/header.php') ?>


<?php

    $id = $_REQUEST['id'];
    $pass_lama = mysqli_real_escape_string($connection, trim($_REQUEST['password_lama']));
    $pass_baru = mysqli_real_escape_string($connection, trim($_REQUEST['password_baru']));

    $SQL = "SELECT
        *
    FROM
        data_user
    WHERE
        id = $id AND
        password = '$pass_lama'
    ;";
    $query = mysqli_query($connection, $SQL);

    if (mysqli_num_rows($query) > 0) {
        
        $SQL = "UPDATE
            data_user
        SET
            password = '$pass_baru'
        WHERE
            id = $id
        ;";
        $query = mysqli_query($connection, $SQL);

        if ($query) {
            echo "<script>
                window.alert('Berhasil mengubah password')
                window.location.href = './profile.php'
            </script>";
            exit();
        } else {
            echo "<script>
                window.alert('Gagal mengganti password. Terjadi kesalahan sistem')
                window.location.href = './profile.php'
            </script>";
            exit();
        }

    } else {

        echo "<script>
            window.alert('Password lama yang dimasukkan salah. Tidak dapat mengganti password')
            window.location.href = './profile.php'
        </script>";
        exit();

    }

?>


<?php require('./template/footer.php') ?>