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
// ambil file input ktp
$temp_pres = $_FILES['image_pres']['tmp_name'];
$name_pres = $_FILES['image_pres']['name'];
$size_pres = $_FILES['image_pres']['size'];
$type_pres = $_FILES['image_pres']['type'];
// ambil file input kk
$temp_wakil = $_FILES['image_w_pres']['tmp_name'];
$name_wakil = $_FILES['image_w_pres']['name'];
$size_wakil = $_FILES['image_w_pres']['size'];
$type_wakil = $_FILES['image_w_pres']['type'];

$fileext_pres = strtolower(pathinfo($name_pres, PATHINFO_EXTENSION));
$fileext_wakil = strtolower(pathinfo($name_wakil, PATHINFO_EXTENSION));

$ext = ['jpeg', 'jpg', 'png'];

if (!$_POST['nama_pres']) {
    array_push($eror, [
        "nama_pres" => "Nama Presiden Tidak Boleh Kosong"
    ]);
}

if (!$_POST['no_pres']) {
    array_push($eror, [
        "no_pres" => "No Urut Presiden Tidak Boleh Kosong"
    ]);
}

if (!$_POST['nama_w_pres']) {
    array_push($eror, [
        "nama_w_pres" => "Nama Wakil Presiden Tidak Boleh Kosong"
    ]);
}

if (!$_POST['no_wakil']) {
    array_push($eror, [
        "no_wakil" => "No Urut Wakil Presiden Tidak Boleh Kosong"
    ]);
}

if (!$_POST['visi']) {
    array_push($eror, [
        "visi" => "visi tidak Boleh Kosong"
    ]);
}

if (!$_POST['misi']) {
    array_push($eror, [
        "misi" => "misi tidak Boleh Kosong"
    ]);
}

if ($size_pres > 5000000) {
    array_push($eror, [
        'gambar' => 'gambar KTP tidak boleh lebig dari 5mb'
    ]);
}

if ($size_wakil > 5000000) {
    array_push($eror, [
        'gambar' => 'gambar KK tidak boleh lebig dari 5mb'
    ]);
}

if (!in_array($fileext_pres, $ext)) {
    array_push($eror, [
        'gambar_presiden' => 'format gambar presiden harus png jpg dan jpeg'
    ]);
}

if (!in_array($fileext_wakil, $ext)) {
    array_push($eror, [
        'gambar_wakil' => 'format gambar wakil harus png jpg dan jpeg'
    ]);
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
$params['nama_pres'] = $_POST['nama_pres'];
$params['nama_w_pres'] = $_POST['nama_w_pres'];
$params['visi'] = $_POST['visi'];
$params['misi'] = $_POST['misi'];
$params['temp_pres'] = $temp_pres;
$params['name_pres'] = $name_pres;
$params['size_pres'] = $size_pres;
$params['type_pres'] = $type_pres;
$params['temp_wakil'] = $temp_wakil;
$params['name_wakil'] = $name_wakil;
$params['size_wakil'] = $size_wakil;
$params['type_wakil'] = $type_wakil;
$object = json_decode(json_encode($params));
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
    $login = createKandidat($object);
    if ($login) {
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'status' => 'success',
            'message' => 'data kandidat berhasiil di tambahkan',
            'data'  => null
        ]);
    } else {
        http_response_code(422);
        echo json_encode([
            'code' => 422,
            'status' => 'Error',
            'message' => 'data kandidat gagal di tambahkan',
            'data'  => null
        ]);
    }
    exit();
} catch (\Exception $e) {
    echo json_encode([
        'code' => 422,
        'status' => 'Error',
        'message' => 'data kandidat gagal di tambahkan',
        'data'  => $e->getMessage()
    ]);
}
