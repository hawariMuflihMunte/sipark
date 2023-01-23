<?php require('./functions/session.php') ?>

<?php if (!isset($_SESSION['role'])): ?>

    <?php

        echo "<script defer>
            window.location.href = './index.php'
        </script>";
        exit();
        return;
        
    ?>

<?php else: ?>

    <!--Navbar-->
    <nav style="
        padding-left: 26px;
        padding-right: 26px;
    " class="uk-navbar-container uk-margin no-print" id="navbar" uk-navbar="mode: click">
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav hide-md-lg">
                <li><a href="#"><i id="sidenav-trigger" class="bi-list uk-text-large"></i></a></li>
            </ul>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="#"><?php echo $_SESSION['name']; ?>&nbsp;&nbsp;<i class="bi-person-circle uk-text-large"></i></a>
                    <div class="uk-navbar-dropdown bg-light">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li><a href="./profile.php" style="font-size: 16px; color: <?= basename($_SERVER['SCRIPT_FILENAME']) == 'profile.php' ? 'black' : '' ?>"><i class="bi-person"></i> Profil Saya</a></li>
                            <li><a href="./logout.php" class="text-danger" id="logout" style="font-size: 16px;"><i class="bi-box-arrow-left"></i> Keluar</a></li>
                            <script>
                                const logOut = document.getElementById('logout')

                                logOut.addEventListener('click', (event) => {
                                    event.returnValue = false

                                    const logOutRef = logOut.getAttribute('href')

                                    Swal.fire({
                                        title: 'Keluar ?',
                                        text: "Apakah kamu yakin ingin keluar dari aplikasi ?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#d33',
                                        confirmButtonText: 'Ya',
                                        cancelButtonColor: '#3085d6',
                                        cancelButtonText: 'Tidak'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = `./${logOutRef}`
                                        }
                                    })
                                })
                            </script>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!--End navbar-->

    <!-- Sidenav -->
    <div id="sidenav" class="sidenav uk-position-absolute uk-position-left uk-flex uk-flex-column uk-flex-between color-1 no-print">
        <ul class="uk-flex uk-flex-column text-light">
            <li>
                <a href="./page.php" class="logo-container non-hoverable">
                    <img src="./assets/image/SIPARK.png" alt="SIPARK image">
                </a>
            </li>
            <li><hr></li>
            <li class="sidenav-subtitle">UMUM</li>
            <li><a href="./page.php" class="<?php if (basename($_SERVER['SCRIPT_FILENAME']) == 'page.php') echo 'active'; else echo ''; ?>"><i class="bi-speedometer"></i>&nbsp;&nbsp;Dashboard</a></li>
            <li><hr></li>
            <li class="sidenav-subtitle">MANAJEMEN KENDARAAN</li>
                <?php if ($_SESSION['role'] != 0): ?>
                    <li>
                    <!-- !Small -->
                    <div class="uk-inline uk-width-1-1 hide-md-lg">
                        <a href="#" class="<?php if (basename($_SERVER['SCRIPT_FILENAME']) == 'veh.in.php' || basename($_SERVER['SCRIPT_FILENAME']) == 'veh.out.php') echo 'active'; else echo ''; ?>"><i class="bi-p-circle-fill"></i>&nbsp;&nbsp;Parkir</a>
                        <div style="
                            padding: 0;
                            border-radius: 2px;
                            overflow: hidden;
                        " class="bg-light" uk-dropdown="mode: click">
                            <ul class="uk-nav uk-dropdown-nav">
                                <style>
                                    .park-dropdown.active {
                                        background-color: rgba(220, 220, 220, 0.9);
                                    }
                                </style>
                                <li
                                    class="park-dropdown
                                    <?php if (basename($_SERVER['SCRIPT_FILENAME']) == 'veh.in.php') echo 'active'; else echo ''; ?>">
                                        <a style="
                                            display: flex;
                                            align-items: center;
                                            justify-content: flex-start;
                                            padding: 7px 20px;
                                        " href="./veh.in.php" class="text-success non-hoverable"><i class="bi-box-arrow-in-left"></i> Kendaraan Masuk</a>
                                </li>
                                <li
                                    class="park-dropdown
                                    <?php if (basename($_SERVER['SCRIPT_FILENAME']) == 'veh.out.php') echo 'active'; else echo ''; ?>">
                                        <a style="
                                            display: flex;
                                            align-items: center;
                                            justify-content: flex-start;
                                            padding: 7px 20px;
                                        " href="./veh.out.php" class="text-danger non-hoverable"><i class="bi-box-arrow-right"></i> Kendaraan Keluar</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End !Small -->
                    <!-- Small -->
                    <div class="uk-inline uk-width-1-1 hide-sm">
                        <a href="#" class="<?php if (basename($_SERVER['SCRIPT_FILENAME']) == 'veh.in.php' || basename($_SERVER['SCRIPT_FILENAME']) == 'veh.out.php') echo 'active'; else echo ''; ?>"><i class="bi-p-circle-fill"></i>&nbsp;&nbsp;Parkir</a>
                        <div style="
                            padding: 0;
                            border-radius: 2px;
                            overflow: hidden;
                        " class="bg-light" uk-dropdown="pos: right-top; mode: click">
                            <ul class="uk-nav uk-dropdown-nav">
                                <style>
                                    .park-dropdown.active {
                                        background-color: rgba(220, 220, 220, 0.9);
                                    }
                                </style>
                                <li class="park-dropdown <?php if (basename($_SERVER['SCRIPT_FILENAME']) == 'veh.in.php') echo 'active'; else echo ''; ?>">
                                    <a style="
                                        display: flex;
                                        align-items: center;
                                        justify-content: flex-start;
                                        padding: 7px 20px;
                                    " href="./veh.in.php" class="text-success non-hoverable"><i class="bi-box-arrow-in-left"></i> Kendaraan Masuk</a>
                                </li>
                                <li class="park-dropdown <?php if (basename($_SERVER['SCRIPT_FILENAME']) == 'veh.out.php') echo 'active'; else echo ''; ?>">
                                    <a style="
                                        display: flex;
                                        align-items: center;
                                        justify-content: flex-start;
                                        padding: 7px 20px;
                                    " href="./veh.out.php" class="text-danger non-hoverable"><i class="bi-box-arrow-right"></i> Kendaraan Keluar</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Small -->
                </li>
            <?php endif; ?>
            <li><a href="./veh.report.php" class="<?php if (basename($_SERVER['SCRIPT_FILENAME']) == 'veh.report.php') echo 'active'; else echo ''; ?>"><i class="bi-file-earmark-spreadsheet"></i>&nbsp;&nbsp;Laporan Parkir</a></li>
            <?php if ($_SESSION['role'] == 0): ?>
                <li><a href="./veh.bill.php" class="<?php if (basename($_SERVER['SCRIPT_FILENAME']) == 'veh.bill.php') echo 'active'; else echo ''; ?>"><i class="bi-wallet-fill"></i>&nbsp;&nbsp;Biaya Parkir</a></li>
            <?php endif; ?>
            <?php if ($_SESSION['role'] != 1): ?>
                <li><hr></li>
                <li class="sidenav-subtitle">MANAJEMEN PETUGAS</li>
                <li>
                    <a href="./functionary.php" class="<?= basename($_SERVER['SCRIPT_FILENAME']) == 'functionary.php' ? 'active' : '' ?>"><i class="bi bi-file-earmark-person-fill"></i>&nbsp;&nbsp;Petugas</a>
                </li>
                <li>
                    <a href="./functionary.report.php" class="<?= basename($_SERVER['SCRIPT_FILENAME']) == 'functionary.report.php' ? 'active' : '' ?>"><i class="bi bi-file-earmark-spreadsheet"></i>&nbsp;&nbsp;Laporan Petugas</a>
                </li>
            <?php endif; ?>
        </ul>
        <span class="sidenav-close hide-md-lg" id="sidenav-close">
            <i class="bi-x-lg"></i>&nbsp;&nbsp;Tutup
        </span>
    </div>
    <!-- End sidenav -->

<?php endif; ?>