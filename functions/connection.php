<?php

$hostname = "localhost" ?? $_SERVER['SCRIPT_FILENAME'];
$username = "root";
$password = "";
$database = "manajemen_parkir";

$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die('Gagal terhubung ke database'.mysqli_connect_error());
}