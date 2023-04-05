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

$headers = getallheaders();
if (!isset($headers['Authorization'])) {
    http_response_code(401);
    exit();
}

list(, $token) = explode(' ', $headers['Authorization']);
try {
    // Men-decode token. Dalam library ini juga sudah sekaligus memverfikasinya
    http_response_code(200);
    $decode = JWT::decode($token, new Key($secret, 'HS256'));
    if ($decode->role != "Admin") {
        http_response_code(401);
        echo json_encode([
            'code' => 401,
            'status' => 'Error',
            'message'  => "data hanya boleh di ambil dengan role admin"
        ]);
        exit();
    }
    $profile = getAllUsers();
    echo json_encode([
        'code' => 200,
        'status' => 'success',
        'data'  => $profile
    ]);
    die;
} catch (Exception $e) {
    // Bagian ini akan jalan jika terdapat error saat JWT diverifikasi atau di-decode
    http_response_code(401);
    echo json_encode([
        'code' => 401,
        'status' => 'Error',
        'data'  => $e->getMessage()
    ]);
    exit();
}
