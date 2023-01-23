<!DOCTYPE html>
<html>
<head>

    <?php setlocale(LC_ALL, "id_ID") ?>

    <title>
        SIPARK |
        <?php
        
            $currentPage = basename($_SERVER['SCRIPT_FILENAME']);
            switch($currentPage) {
                case 'index.php':
                    echo "Masuk";
                    break;
                case 'page.php':
                    echo "Dashboard";
                    break;
                case 'profile.php':
                    echo "Profil";
                    break;
                case 'veh.in.php':
                    echo "Kendaraan Masuk";
                    break;
                case 'veh.out.php':
                    echo "Kendaraan Keluar";
                    break;
                case 'veh.report.php':
                    echo "Laporan Kendaraan";
                    break;
                case 'functionary.php':
                    echo "Data Petugas";
                    break;
                case 'functionary.report.php':
                    echo "Laporan Data Petugas";
                    break;
            }
        
        ?>
    </title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- UIkit -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.3/dist/css/uikit.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.3/dist/js/uikit.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/image/SIPARK.png" type="image/x-icon">

    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --color-1: #607EAA;
            --color-2: #1C3879;
        }

        .color-1 {
            background-color: var(--color-1);
        }

        .text-color-1 {
            color: var(--color-1);
        }

        .color-2 {
            background-color: var(--color-2);
        }

        .text-color-2 {
            color: var(--color-2);
        }

        a:hover {
            color: currentColor;
            text-decoration: none;
        }

        .sidenav {
            min-width: 200px;
            max-width: 280px;
            min-height: 60vh;
            height: 100%;
            z-index: 1010;
            transition: all 250ms linear;

        }

        @media only screen and (max-width: 576px) {
            .sidenav {
                left: -100%;
            }
        }

        .sidenav ul {
            list-style: none;
            padding: 0 !important;
        }

        .sidenav a,
        .sidenav-close {
            color: inherit;
            display: flex;
            align-items: center;
            text-decoration: none;
            padding: 11px;
            width: 100%;
            cursor: pointer;
            transition: all 280ms linear;
        }

        .sidenav-close {
            background-color: #CFD2CF;
        }

        .sidenav a:not(.non-hoverable):hover {
            background-color: var(--color-2);
        }

        .sidenav a.active {
            background-color: var(--color-2);
        }

        .sidenav-close:hover {
            background-color: #D61C4E;
            color: white;
        }

        .sidenav ul,
        .sidenav ul li {
            padding: 0;
            margin: 0;
        }

        .show-sidenav {
            transform: translateX(100vw);
        }

        @media only screen and (max-width: 576px) {
            .background-fader {
                box-shadow: 0 0 0 999px rgba(0, 0, 0, 0.75);
            }

            .disable {
                pointer-events: none;
            }   
        }

        @media only screen and (min-width: 577px) {
            .show-sidenav {
                transform: translateX(0px) !important;
            }
        }

        .sidenav a.logo-container {
            place-content: center;
        }

        .sidenav a.text-success:hover,
        .sidenav a.text-danger:hover {
            background-color: rgba(220, 220, 220, 0.9);
        }

        .sidenav a img {
            max-width: 80px;
            width: 100%;
        }

        main, nav {
            margin-left: 200px;
        }

        main {
            padding: 14px 16px;
        }

        @media only screen and (max-width: 576px) {
            main, nav {
                margin-left: 0;
            }
        }

        @media only screen and (max-width: 576px) {
            .hide-sm {
                display: none !important;
            }
        }

        @media only screen and (min-width: 577px) {
            .hide-md-lg {
                display: none !important;
            }   
        }

        .sidenav-subtitle {
            display: block;
            color: rgba(220, 220, 220, 0.9);
            font-size: 14px;
            margin-left: 5px !important;
        }

        @media screen {
            .no-screen {
                display: none;
            }

            .custom-height-print {
                max-height: 260px;
                overflow-y: auto;
            }
        }

        @media print {
            .no-print {
                display: none;
            }

            main {
                padding: 0;
                padding-top: 50px;
                margin: 0;
            }

            .custom-height-print {
                max-width: max-content;
                overflow-y: visible;
            }
        }
    </style>

<body>