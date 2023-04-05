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
    $roles = isset($data->role) ? $data->role : 0;
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
        role,
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
            '$roles',
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
    $query = mysqli_query($koneksi, "SELECT nik,nama,password,role FROM user WHERE nik='$data->nik'");
    $cek = mysqli_num_rows($query);
    list($nik, $nama, $password, $role) = mysqli_fetch_array($query);
    $roles = "";
    switch ($role) {
        case '0':
            $roles = "User";
            break;

        case '1':
            $roles = "Admin";
            break;

        default:
            # code...
            break;
    }
    $record = [];
    if ($cek > 0) {
        if (password_verify($data->password, $password)) {
            $record = [
                "nik" => $nik,
                "nama" => $nama,
                "role" => $roles,
            ];
        }
    }
    return $record;
}

function getProfile($nik)
{
    global $koneksi;

    $query = mysqli_query($koneksi, "SELECT user.id AS user_id,
    user.nik,
    user.nama,
    user.email,
    user.role,
    user.id_jk,
    provinsi.id AS provin_id,
    provinsi.name AS name_provin,
    provinsi.meta AS meta_provin,
    kota.id AS kota_id,
    kota.name AS kota_name,
    kota.meta AS meta_kota,
    kecamatan.id AS kecamatan_id,
    kecamatan.name AS name_keca,
    kecamatan.meta AS meta_keca,
    kelurahan.id AS kelurahan_id,
    kelurahan.name AS name_kelu,
    kelurahan.meta AS meta_kelu,
    user.rt,user.rw,
    user.foto_ktp,
    user.foto_kk
    FROM user 
    INNER JOIN provinsi ON user.id_provinsi = provinsi.id
    INNER JOIN kota ON user.id_kota = kota.id
    INNER JOIN kecamatan ON user.id_kecamatan = kecamatan.id
    INNER JOIN kelurahan ON user.id_kelurahan = kelurahan.id
    WHERE user.nik='$nik'");

    $record = [];
    $cek = mysqli_fetch_array($query);
    $roles = "";
    $jk = "";
    switch ($cek['role']) {
        case '0':
            $roles = "User";
            break;

        case '1':
            $roles = "Admin";
            break;

        default:
            # code...
            break;
    }
    switch ($cek['id_jk']) {
        case '1':
            $jk = "Laki - Laki";
            break;

        case '2':
            $jk = "Perempuan";
            break;

        default:
            # code...
            break;
    }
    $record = [
        "id" => $cek['user_id'],
        "nik" => $cek['nik'],
        "nama" => $cek['nama'],
        "email" => $cek['email'],
        "role" => $roles,
        "jenis_kelamin" => $jk,
        "provinsi" => [
            "id" => $cek['provin_id'],
            "name" => $cek['name_provin'],
            "meta" => $cek['meta_provin']
        ],
        "kota" => [
            "id" => $cek['kota_id'],
            "name" => $cek['kota_name'],
            "meta" => $cek['meta_kota']
        ],
        "kecamatan" => [
            "id" => $cek['kecamatan_id'],
            "name" => $cek['name_keca'],
            "meta" => $cek['meta_keca']
        ],
        "kelurahan" => [
            "id" => $cek['kelurahan_id'],
            "name" => $cek['name_kelu'],
            "meta" => $cek['meta_kelu']
        ],
        "rt" => $cek['rt'],
        "rw" => $cek['rw'],
        "foto_ktp" => $cek['foto_ktp'],
        "foto_kk" => $cek['foto_kk'],
    ];
    return $record;
}

function getAllUsers()
{
    global $koneksi;

    $query = mysqli_query($koneksi, "SELECT user.id AS user_id,
    user.nik,
    user.nama,
    user.email,
    user.role,
    user.id_jk,
    provinsi.id AS provin_id,
    provinsi.name AS name_provin,
    provinsi.meta AS meta_provin,
    kota.id AS kota_id,
    kota.name AS kota_name,
    kota.meta AS meta_kota,
    kecamatan.id AS kecamatan_id,
    kecamatan.name AS name_keca,
    kecamatan.meta AS meta_keca,
    kelurahan.id AS kelurahan_id,
    kelurahan.name AS name_kelu,
    kelurahan.meta AS meta_kelu,
    user.rt,user.rw,
    user.foto_ktp,
    user.foto_kk
    FROM user 
    INNER JOIN provinsi ON user.id_provinsi = provinsi.id
    INNER JOIN kota ON user.id_kota = kota.id
    INNER JOIN kecamatan ON user.id_kecamatan = kecamatan.id
    INNER JOIN kelurahan ON user.id_kelurahan = kelurahan.id");

    $record = [];
    while ($data = mysqli_fetch_assoc($query)) {
        $roles = "";
        $jk = "";
        switch ($data['role']) {
            case '0':
                $roles = "User";
                break;

            case '1':
                $roles = "Admin";
                break;

            default:
                # code...
                break;
        }
        switch ($data['id_jk']) {
            case '1':
                $jk = "Laki - Laki";
                break;

            case '2':
                $jk = "Perempuan";
                break;

            default:
                # code...
                break;
        }
        array_push($record, [
            "id" => $data['user_id'],
            "nik" => $data['nik'],
            "nama" => $data['nama'],
            "email" => $data['email'],
            "role" => $roles,
            "jenis_kelamin" => $jk,
            "provinsi" => [
                "id" => $data['provin_id'],
                "name" => $data['name_provin'],
                "meta" => $data['meta_provin']
            ],
            "kota" => [
                "id" => $data['kota_id'],
                "name" => $data['kota_name'],
                "meta" => $data['meta_kota']
            ],
            "kecamatan" => [
                "id" => $data['kecamatan_id'],
                "name" => $data['name_keca'],
                "meta" => $data['meta_keca']
            ],
            "kelurahan" => [
                "id" => $data['kelurahan_id'],
                "name" => $data['name_kelu'],
                "meta" => $data['meta_kelu']
            ],
            "rt" => $data['rt'],
            "rw" => $data['rw'],
            "foto_ktp" => $data['foto_ktp'],
            "foto_kk" => $data['foto_kk'],
        ]);
    }
    return $record;
}

function updateUser($data)
{
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT * FROM user where id='$data->id'");
    $tm_cari = mysqli_fetch_array($query);
    if (!isset($tm_cari['id'])) {
        return false;
    }
    $roles = isset($data->role) ? $data->role : 0;
    $folder = $_SERVER['DOCUMENT_ROOT'] . "/file_upload/";
    if (!empty($data->temp_ktp) || !empty($data->temp_kk)) {
        $file_ktp = $tm_cari['foto_ktp'];
        $folder_ktp = $_SERVER['DOCUMENT_ROOT'] . "/file_upload/" . $file_ktp;
        if (file_exists($folder_ktp)) {
            unlink($folder_ktp);
        }

        $file_kk = $tm_cari['foto_kk'];
        $folder_kk = $_SERVER['DOCUMENT_ROOT'] . "/file_upload/" . $file_kk;
        if (file_exists($folder_kk)) {
            unlink($folder_kk);
        }

        $foto_ktp = "../file_upload/" . $data->name_ktp;
        $foto_kk = "../file_upload/" . $data->name_kk;
        $name_ktp = basename($data->name_ktp);
        move_uploaded_file($data->temp_ktp, $folder . $name_ktp);
        $name_kk = basename($data->name_kk);
        move_uploaded_file($data->temp_kk, $folder . $name_kk);
        mysqli_query($koneksi, "UPDATE user SET nik='$data->nik',
        nama='$data->nama',
        id_jk='$data->id_jk',
        id_provinsi='$data->id_provinsi',
        id_kota='$data->id_kota',
        id_kecamatan='$data->id_kecamatan',
        id_kelurahan='$data->id_kelurahan',
        role='$roles',
        rt='$data->rt',
        rw='$data->rw',
        foto_ktp='$foto_ktp',
        foto_kk='$foto_kk' WHERE id='$data->id'
        ") or die(mysqli_error($koneksi));
        return true;
    } else {
        mysqli_query($koneksi, "UPDATE user SET nik='$data->nik',
        nama='$data->nama',
        id_jk='$data->id_jk',
        id_provinsi='$data->id_provinsi',
        id_kota='$data->id_kota',
        id_kecamatan='$data->id_kecamatan',
        id_kelurahan='$data->id_kelurahan',
        role='$roles',
        rt='$data->rt',
        rw='$data->rw' WHERE id='$data->id'
        ") or die(mysqli_error($koneksi));
        return true;
    }
}

function deleteUser($data)
{
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT * FROM user where id='$data->id'");
    $tm_cari = mysqli_fetch_array($query);
    if (!isset($tm_cari['id'])) {
        return false;
    }

    $file_ktp = $tm_cari['foto_ktp'];
    $folder_ktp = $_SERVER['DOCUMENT_ROOT'] . "/file_upload/" . $file_ktp;
    if (file_exists($folder_ktp)) {
        unlink($folder_ktp);
    }

    $file_kk = $tm_cari['foto_kk'];
    $folder_kk = $_SERVER['DOCUMENT_ROOT'] . "/file_upload/" . $file_kk;
    if (file_exists($folder_kk)) {
        unlink($folder_kk);
    }

    mysqli_query($koneksi, "DELETE FROM user WHERE id='$data->id'") or die(mysqli_error($koneksi));
    return true;
}
