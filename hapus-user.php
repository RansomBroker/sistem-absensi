<?php

include "connection.php";
include "helper.php";

$id = $_GET['id'];
$role = isset($_GET['role']) ? $_GET['role'] : null;
$query = $connection->query("
    DELETE FROM users WHERE id = '$id'
");

if ($role  == 2) {
    redirect('dosen.php');
}

if ($role  == 3) {
    redirect('mahasiswa.php');
}

if ($role == null) {
    redirect('user.php');
}