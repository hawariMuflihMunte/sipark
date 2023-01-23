<?php include('./functions/session.php') ?>
<?php include('./functions/connection.php') ?>
<?php require('./template/header.php') ?>

<?php if (!isset($_SESSION['role'])): ?>
    <?php
        echo "<script>
            window.location.href = 'index.php'
        </script>";
        exit();
    ?>
<?php else: ?>
    <?php

        $id = $_SESSION['id'];
        $SQL = "UPDATE
            data_user
        SET
            riwayat_keluar = NOW()
        WHERE
            id = $id
        ;";
        $query = mysqli_query($connection, $SQL);

        if ($query) { // success
            session_unset();
            session_destroy();
            mysqli_close($connection);
        }

    ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Berhasil keluar dari sistem. Kamu akan dikeluarkan dari sistem setelah klik OK',
            confirmButtonText: 'OK',
        }).then((result) => {
            window.location.href = './index.php'
        })
    </script>
<?php endif; ?>