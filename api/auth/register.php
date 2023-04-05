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
// ambil file input ktp
$temp_ktp = $_FILES['foto_ktp']['tmp_name'];
$name_ktp = $_FILES['foto_ktp']['name'];
$size_ktp = $_FILES['foto_ktp']['size'];
$type_ktp = $_FILES['foto_ktp']['type'];
// ambil file input kk
$temp_kk = $_FILES['foto_kk']['tmp_name'];
$name_kk = $_FILES['foto_kk']['name'];
$size_kk = $_FILES['foto_kk']['size'];
$type_kk = $_FILES['foto_kk']['type'];

$fileext_ktp = strtolower(pathinfo($name_ktp, PATHINFO_EXTENSION));
$fileext_kk = strtolower(pathinfo($name_kk, PATHINFO_EXTENSION));

$ext = ['jpeg', 'jpg', 'png'];

if (!$_POST['nik']) {
    array_push($eror, [
        "nik" => "tidak Boleh Kosong"
    ]);
}

if (!$_POST['nik']) {
    array_push($eror, [
        "nik" => "tidak Boleh Kosong"
    ]);
}

if (isset($_POST['nik'])) {
    $leng = strlen($_POST['nik']);
    if (!is_numeric($_POST['nik'])) {
        array_push($eror, [
            'nik' => 'Nik Suport Numeric'
        ]);
    }
    if ($leng < 16) {
        array_push($eror, [
            'nik' => 'Nik Min 16 Karakter'
        ]);
    }
    if ($leng > 16) {
        array_push($eror, [
            'nik' => 'Nik Max 16 Karakter'
        ]);
    }
}

if (!$_POST['email']) {
    array_push($eror, [
        "email" => "tidak Boleh Kosong"
    ]);
}

if (!$_POST['email']) {
    array_push($eror, [
        "email" => "tidak Boleh Kosong"
    ]);
}

if (!$_POST['password']) {
    array_push($eror, [
        "password" => "tidak Boleh Kosong"
    ]);
}

if (!$_POST['id_jk']) {
    array_push($eror, [
        "id_jk" => "tidak Boleh Kosong"
    ]);
}

if (!$_POST['id_provinsi']) {
    array_push($eror, [
        "id_provinsi" => "tidak Boleh Kosong"
    ]);
}

if (!$_POST['id_kota']) {
    array_push($eror, [
        "id_kota" => "tidak Boleh Kosong"
    ]);
}

if (!$_POST['id_kecamatan']) {
    array_push($eror, [
        "id_kecamatan" => "tidak Boleh Kosong"
    ]);
}

if (!$_POST['id_kelurahan']) {
    array_push($eror, [
        "id_kelurahan" => "tidak Boleh Kosong"
    ]);
}

if (!$_POST['rt']) {
    array_push($eror, [
        "rt" => "tidak Boleh Kosong"
    ]);
}

if (!$_POST['rw']) {
    array_push($eror, [
        "rw" => "tidak Boleh Kosong"
    ]);
}

if ($size_ktp > 5000000) {
    array_push($eror, [
        'gambar' => 'gambar KTP tidak boleh lebig dari 5mb'
    ]);
}

if ($size_kk > 5000000) {
    array_push($eror, [
        'gambar' => 'gambar KK tidak boleh lebig dari 5mb'
    ]);
}

if (!in_array($fileext_ktp, $ext)) {
    array_push($eror, [
        'gambar_ktp' => 'format gambar KTP harus png jpg dan jpeg'
    ]);
}

if (!in_array($fileext_kk, $ext)) {
    array_push($eror, [
        'gambar_kk' => 'format gambar KK harus png jpg dan jpeg'
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
$params['nik'] = $_POST['nik'];
$params['nama'] = $_POST['nama'];
$params['email'] = $_POST['email'];
$params['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
$params['id_jk'] = $_POST['id_jk'];
$params['id_provinsi'] = $_POST['id_provinsi'];
$params['id_kota'] = $_POST['id_kota'];
$params['id_kecamatan'] = $_POST['id_kecamatan'];
$params['id_kelurahan'] = $_POST['id_kelurahan'];
$params['role'] = $_POST['role'];
$params['rt'] = $_POST['rt'];
$params['rw'] = $_POST['rw'];
$params['temp_ktp'] = $temp_ktp;
$params['name_ktp'] = $name_ktp;
$params['size_ktp'] = $size_ktp;
$params['type_ktp'] = $type_ktp;
$params['temp_kk'] = $temp_kk;
$params['name_kk'] = $name_kk;
$params['size_kk'] = $size_kk;
$params['type_kk'] = $type_kk;
$object = json_decode(json_encode($params));
try {
    $login = register($object);
    if ($login) {
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'status' => 'success',
            'message' => 'data register berhasiil di tambahkan',
            'data'  => null
        ]);
    } else {
        http_response_code(422);
        echo json_encode([
            'code' => 422,
            'status' => 'Error',
            'message' => 'data register gagal di tambahkan',
            'data'  => null
        ]);
    }
    exit();
} catch (\Exception $e) {
    echo json_encode([
        'code' => 422,
        'status' => 'Error',
        'message' => 'data register gagal di tambahkan',
        'data'  => $e->getMessage()
    ]);
}
