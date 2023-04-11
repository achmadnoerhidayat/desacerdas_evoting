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

if (!$input->kandidat_id) {
    array_push($eror, [
        "kandidat_id" => "Kandidat Tidak Boleh Kosong"
    ]);
}

if (isset($input->kandidat_id)) {
    $leng = strlen($input->kandidat_id);
    if (!is_numeric($input->kandidat_id)) {
        array_push($eror, [
            'kandidat_id' => 'Kandidat id Suport Numeric'
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
    $input->user_id = $decode->id;
    $login = createSuara($input);
    if ($login) {
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'status' => 'success',
            'message' => 'data suara berhasiil di tambahkan',
            'data'  => null
        ]);
    } else {
        http_response_code(422);
        echo json_encode([
            'code' => 422,
            'status' => 'Error',
            'message' => 'data suara gagal di tambahkan',
            'data'  => null
        ]);
    }
    exit();
} catch (\Exception $e) {
    echo json_encode([
        'code' => 422,
        'status' => 'Error',
        'message' => 'data suara gagal di tambahkan',
        'data'  => $e->getMessage()
    ]);
}
