<?php
include "connection.php";

$enroll_code = $_GET['enroll-code'];
$id = $_GET['id'];
$response = [];
$mata_kuliah = $connection->query("SELECT * FROM mata_kuliah WHERE enroll_code = '$enroll_code'")->fetch_assoc();

if (is_null($mata_kuliah) == false){
    $id_mata_kuliah = $mata_kuliah['id'];
    // masuk kelas
    $connection->query("INSERT INTO mahasiswa_enroll (user_id, mata_kuliah_id) VALUES ('$id', '$id_mata_kuliah')");

    if ($connection->affected_rows > 0 ) {
        $response[] = [
            'message' => 'Berhasil Menambahkan Kelas',
            'status' => 'success',
            'code' => 1
        ];

        echo json_encode($response);
    } else {
        $response[] = [
            'message' => 'Something wn',
            'status' => 'failed',
            'code' => 0
        ];
        echo json_encode($response);
    }
} else {
    // jika kode salah
    $response[] = [
        'message' => 'Kelas Tidak Ditemukan',
        'status' => 'failed',
        'code' => 0
    ];

    echo  json_encode($response);
}