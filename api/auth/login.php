<?php
require_once("../../vendor/autoload.php");
require_once("../..//src/apidb.php");

use Firebase\JWT\JWT;

header('Content-Type: application/json');

$secret = "j2A4jMHYe5jEWO5587mnu";

// Cek method request apakah POST atau tidak
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit();
}

// Ambil JSON yang dikirim oleh user
$json = file_get_contents('php://input');

// Decode json tersebut agar mudah mengambil nilainya
$input = json_decode($json);

// token exp 8 jam
$expired_time = time() + (480 * 60);

$error = [];
if (!$input->nik) {
    array_push($error, [
        "nik" => "Nik Tidak Boleh Kosong"
    ]);
}

if (isset($input->nik)) {
    $leng = strlen($input->nik);
    if (!is_numeric($input->nik)) {
        array_push($error, [
            'nik' => 'Nik Suport Numeric'
        ]);
    }
    if ($leng < 16) {
        array_push($error, [
            'nik' => 'Nik Min 16 Karakter'
        ]);
    }
    if ($leng > 16) {
        array_push($error, [
            'nik' => 'Nik Max 16 Karakter'
        ]);
    }
}

if (!$input->password) {
    array_push($error, [
        "password" => "Password Tidak Boleh Kosong"
    ]);
}

if (count($error) > 0) {
    http_response_code(422);
    echo json_encode([
        'code' => 422,
        'status' => 'error',
        'error' => $error,
    ]);
    exit();
}

if (isset($input->nik) || isset($input->password)) {
    $login = login($input);
    $coun = count($login);
    if ($coun > 0) {
        http_response_code(200);
        $access_token = JWT::encode($login, $secret, 'HS256');
        $response = [
            'user' => [
                'nik' => $login['nik'],
                'nama' => $login['nama'],
                'role' => $login['role'],
            ],
            'token_type' => "Bearer",
            'token' => $access_token,
            'expiry' => date(DATE_ISO8601, $expired_time)
        ];
        echo json_encode([
            'code' => 200,
            'status' => "success",
            'message' => "berhasil login",
            "data"  => $response
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'code' => 404,
            'status' => "error",
            'message' => "nik dan password salah"
        ]);
    }
}
