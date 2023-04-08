<?php

include "connection.php";
include "helper.php";

$id = $_GET['id'];
$query = $connection->query("
    DELETE FROM jadwal_presensi WHERE id = '$id'
");
redirect('data-absen.php');
