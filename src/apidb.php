<?php
// production
$koneksi = mysqli_connect("localhost", "u4884394_desacerdas_evot", "desacerdasevoting", "u4884394_desacerdas_evoting") or die('MySQL connect failed. ' . mysqli_connect_error());

// $koneksi = mysqli_connect("database", "root", "root", "evoting") or die('MySQL connect failed. ' . mysqli_connect_error());

function getWilProfinsi()
{
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT id,name,meta,created_at,updated_at FROM provinsi ORDER BY name ASC");
    $record = [];
    while ($data = mysqli_fetch_assoc($query)) {

        array_push($record, [
            'id' => $data['id'],
            'name' => $data['name'],
            'meta' => $data['meta'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);
    }
    if (count($record) > 0) {
        return $record;
    } else {
        return [];
    }
}

function getCity()
{
    global $koneksi;
    $recordKota = [];
    $qkota = mysqli_query($koneksi, "SELECT id,
        id_provin,
        name,
        meta,
        created_at,
        updated_at
        FROM kota ORDER BY name ASC");
    while ($datakota = mysqli_fetch_assoc($qkota)) {
        array_push($recordKota, [
            'id' => $datakota['id'],
            'name' => $datakota['name'],
            'meta' => $datakota['meta'],
            'created_at' => $datakota['created_at'],
            'updated_at' => $datakota['updated_at'],
        ]);
    }
    if (count($recordKota) > 0) {
        return $recordKota;
    } else {
        return [];
    }
}

function getCityByIdProvinsi($id_prov)
{
    global $koneksi;
    $recordKota = [];
    $qkota = mysqli_query($koneksi, "SELECT id,
        id_provin,
        name,
        meta,
        created_at,
        updated_at
        FROM kota WHERE id_provin='$id_prov' ORDER BY name ASC");
    while ($datakota = mysqli_fetch_assoc($qkota)) {
        array_push($recordKota, [
            'id' => $datakota['id'],
            'name' => $datakota['name'],
            'meta' => $datakota['meta'],
            'created_at' => $datakota['created_at'],
            'updated_at' => $datakota['updated_at'],
        ]);
    }
    if (count($recordKota) > 0) {
        return $recordKota;
    } else {
        return [];
    }
}

function getKecamatan()
{
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT id,name,meta,id_kota,created_at,updated_at FROM kecamatan ORDER BY name ASC");
    $record = [];
    while ($data = mysqli_fetch_assoc($query)) {

        array_push($record, [
            'id' => $data['id'],
            'name' => $data['name'],
            'meta' => $data['meta'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);
    }
    if (count($record) > 0) {
        return $record;
    } else {
        return [];
    }
}

function getKecamatanByIdKota($id_kota)
{
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT id,name,meta,id_kota,created_at,updated_at FROM kecamatan WHERE id_kota='$id_kota' ORDER BY name ASC");
    $record = [];
    while ($data = mysqli_fetch_assoc($query)) {

        array_push($record, [
            'id' => $data['id'],
            'name' => $data['name'],
            'meta' => $data['meta'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);
    }
    if (count($record) > 0) {
        return $record;
    } else {
        return [];
    }
}

function getKelurahan()
{
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT id,name,meta,id_kecamatan ,created_at,updated_at FROM kelurahan ORDER BY name ASC");
    $record = [];
    while ($data = mysqli_fetch_assoc($query)) {

        array_push($record, [
            'id' => $data['id'],
            'name' => $data['name'],
            'meta' => $data['meta'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);
    }
    if (count($record) > 0) {
        return $record;
    } else {
        return [];
    }
}

function getKelurahanByIdKecamatan($id)
{
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT id,name,meta,id_kecamatan,created_at,updated_at FROM kelurahan WHERE id_kecamatan='$id' ORDER BY name ASC");
    $record = [];
    while ($data = mysqli_fetch_assoc($query)) {

        array_push($record, [
            'id' => $data['id'],
            'name' => $data['name'],
            'meta' => $data['meta'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);
    }
    if (count($record) > 0) {
        return $record;
    } else {
        return [];
    }
}

function register($data)
{
    global $koneksi;
    $folder = $_SERVER['DOCUMENT_ROOT'] . "/file_upload/";
    if (!empty($data->temp_ktp) || !empty($data->temp_kk)) {
        $foto_ktp = "../file_upload/" . $data->name_ktp;
        $foto_kk = "../file_upload/" . $data->name_kk;
        $name_ktp = basename($data->name_ktp);
        move_uploaded_file($data->temp_ktp, $folder . $name_ktp);
        $name_kk = basename($data->name_kk);
        move_uploaded_file($data->temp_kk, $folder . $name_kk);
        $query = mysqli_query($koneksi, "INSERT INTO user(
        nik,
        nama,
        email,
        password,
        id_jk,
        id_provinsi,
        id_kota,
        id_kecamatan,
        id_kelurahan,
        rt,
        rw,
        foto_ktp,
        foto_kk) VALUES 
        (
            '$data->nik',
            '$data->nama',
            '$data->email',
            '$data->password',
            '$data->id_jk',
            '$data->id_provinsi',
            '$data->id_kota',
            '$data->id_kecamatan',
            '$data->id_kelurahan',
            '$data->rt',
            '$data->rw',
            '$foto_ktp',
            '$foto_kk'
        )
        ") or die(mysqli_error($koneksi));
        return true;
    }
    return false;
}

function login($data)
{
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT nik,nama,password FROM user WHERE nik='$data->nik'");
    $cek = mysqli_num_rows($query);
    list($nik,$nama, $password) = mysqli_fetch_array($query);
    $record = [];
    if ($cek > 0) {
        if (password_verify($data->password, $password)) {
            $record = [
                "nik" => $nik,
                "nama" => $nama
            ];
        }
    }
    return $record;
}
