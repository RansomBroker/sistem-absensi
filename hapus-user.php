<?php

include "connection.php";
include "helper.php";

$id = $_GET['id'];
$query = $connection->query("
    DELETE FROM users WHERE id = '$id'
");

redirect('user.php.php?halaman=user');