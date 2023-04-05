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
$eror = [];

if (!$_POST['id']) {
    array_push($eror, [
        "id" => "tidak Boleh Kosong"
    ]);
}

if (isset($_POST['id'])) {
    $leng = strlen($_POST['id']);
    if (!is_numeric($_POST['id'])) {
        array_push($eror, [
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
$params = [];
$params['id'] = $_POST['id'];
$object = json_decode(json_encode($params));
try {
    $login = deleteUser($object);
    if ($login) {
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'status' => 'success',
            'message' => 'data user berhasiil di delete',
            'data'  => null
        ]);
    } else {
        http_response_code(422);
        echo json_encode([
            'code' => 422,
            'status' => 'Error',
            'message' => 'data user gagal di delete',
            'data'  => null
        ]);
    }
    exit();
} catch (\Exception $e) {
    echo json_encode([
        'code' => 422,
        'status' => 'Error',
        'message' => 'data user gagal di tambahkan',
        'data'  => $e->getMessage()
    ]);
}
