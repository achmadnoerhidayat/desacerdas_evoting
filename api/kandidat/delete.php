<?php
require_once("../../vendor/autoload.php");
require_once("../..//src/apidb.php");

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

$secret = "j2A4jMHYe5jEWO5587mnu";

// Cek method request apakah POST atau tidak
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit();
}

$headers = getallheaders();
if (!isset($headers['Authorization'])) {
    http_response_code(401);
    exit();
}

list(, $token) = explode(' ', $headers['Authorization']);

// Ambil JSON yang dikirim oleh user
$json = file_get_contents('php://input');

// Decode json tersebut agar mudah mengambil nilainya
$input = json_decode($json);
$eror = [];

if (!$input->id) {
    array_push($eror,[
        "id" => "id tidak boleh kosong"
    ]);
}

if (isset($input->id)) {
    if (!is_numeric($input->id)) {
        array_push($error, [
            'id' => 'id Suport Numeric'
        ]);
    }
}

if (count($eror) > 0) {
    http_response_code(422);
    echo json_encode([
        'code' => 422,
        'status' => 'error',
        'error' => $eror,
    ]);
    exit();
}
try {
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
    $login = deleteKandidat($input);
    if ($login) {
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'status' => 'success',
            'message' => 'data kandidat berhasiil di delete',
            'data'  => null
        ]);
    } else {
        http_response_code(422);
        echo json_encode([
            'code' => 422,
            'status' => 'Error',
            'message' => 'data kandidat gagal di delete',
            'data'  => null
        ]);
    }
    exit();
} catch (\Exception $e) {
    echo json_encode([
        'code' => 422,
        'status' => 'Error',
        'message' => 'data kandidat gagal di delete',
        'data'  => $e->getMessage()
    ]);
}
