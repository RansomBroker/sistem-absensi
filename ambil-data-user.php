<?php
include "connection.php";
$username = $_POST['username'];
$users = $connection->query("SELECT * FROM users WHERE username='$username'")->fetch_assoc();
echo json_encode($users);