<?php
require_once("../../vendor/autoload.php");
require_once("../../src/apidb.php");

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

$secret = "j2A4jMHYe5jEWO5587mnu";

// Cek method request apakah GET atau tidak
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        'code' => 405,
        'status' => 'Error',
        'message'  => "halaman suport methode GET"
    ]);
    exit();
}
try {
    // Men-decode token. Dalam library ini juga sudah sekaligus memverfikasinya
    http_response_code(200);
    if ($_GET['id_kota']) {
        $profile = getKecamatanByIdKota($_GET['id_kota']);
        echo json_encode([
            'code' => 200,
            'status' => 'success',
            'message' => 'data Wilayah kecamatan berhasil ditambahkan',
            'data'  => $profile
        ]);
        die;
    }
    $profile = getKecamatan();
    echo json_encode([
        'code' => 200,
        'status' => 'success',
        'message' => 'data Wilayah kecamatan berhasil ditambahkan',
        'data'  => $profile
    ]);
    die;
} catch (Exception $e) {
    // Bagian ini akan jalan jika terdapat error saat JWT diverifikasi atau di-decode
    http_response_code(401);
    echo json_encode([
        'code' => 401,
        'status' => 'Error',
        'message'  => $e->getMessage()
    ]);
    exit();
}
