<?php

function cek($id)
{
    $data = DB::table('poli')
        ->where('id_poli', '=', $id)
        ->get();

    return $data;
}

function status_poli($id_poli)
{
    $data = DB::table('poli')
        ->where('id_poli', $id_poli)
        ->get();

    $status = $data[0]->status_poli;

    if ($status == 1) {
        return 'Buka';
    }

    if ($status == 0) {
        return 'Tutup';
    }
}

function get_status_antrian($id_antrian)
{
    $data = DB::table('nomor_antrian')
        ->where('id_antrian', $id_antrian)
        ->get();

    $status = $data[0]->status_antrian;

    if ($status == 1) {
        return 'Aktif';
    }

    if ($status == 2) {
        return 'Pass';
    }
}

function cek_role($role)
{
    if ($role == 1) {
        return 'Administrator';
    } elseif ($role == 2) {
        return 'Petugas';
    } else {
        return 'Pasien';
    }
}

function kode_antrian($kode_poli)
{
}

function autonumber($id_terakhir, $panjang_kode, $panjang_angka)
{
    // mengambil nilai kode ex: KNS0015 hasil KNS
    $kode = substr($id_terakhir, 0, $panjang_kode);

    // mengambil nilai angka
    // ex: KNS0015 hasilnya 0015
    $angka = substr($id_terakhir, $panjang_kode, $panjang_angka);

    // menambahkan nilai angka dengan 1
    // kemudian memberikan string 0 agar panjang string angka menjadi 4
    // ex: angka baru = 6 maka ditambahkan strig 0 tiga kali
    // sehingga menjadi 0006
    $angka_baru = str_repeat('0', $panjang_angka - strlen($angka + 1)) . ($angka + 1);

    // menggabungkan kode dengan nilang angka baru
    $id_baru = $kode . $angka_baru;

    return $id_baru;
}

function get_nama_pasien($id_pasien)
{
    $data = DB::table('users')
        ->where('id', $id_pasien)
        ->get();
    return $data[0]->name;
}

function get_nama_poli($id_poli)
{
    $data = DB::table('poli')
        ->where('id_poli', $id_poli)
        ->get();
    return $data[0]->nama_poli;
}
function get_name_antrian($id_antrian)
{
    $data = DB::table('nomor_antrian')
        ->where('id_antrian', $id_antrian)
        ->get();
    if (empty($data[0]->id_antrian)) {
        return 'kosong';
    } else {
        // dd($data);
        return $data[0]->nomor_antrian;
    }
}
function cek_finish_antrian($id)
{
    $data = DB::table('nomor_antrian')
        ->where('nomor_antrian', $id)
        ->where('status_antrian', 3)
        ->get()
        ->count();
    if ($data > 0) {
        return 1;
    } else {
        return 0;
    }
}
function get_nomor_antrian($id)
{
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date('Y-m-d');
    $data = DB::table('nomor_antrian')
        ->where('id_poli', $id)
        ->where('created_at', 'like', '%' . $tanggal . '%')
        ->get();
    return $data;
}

function get_antrian_sekarang($id_poli)
{
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date('Y-m-d');

    $data = DB::table('record_antrian')
        ->where('id_poli', $id_poli)
        ->where('created_at', 'like', '%' . $tanggal . '%')
        ->orderBY('id_record', 'desc')
        ->limit(1)
        ->get();
    // $id_antrian = $data[0]->id_antrian;
    if (empty($data[0]->id_antrian)) {
        return 'Antrian Belum Ada';
    } else {
        // dd($data);
        return get_name_antrian($data[0]->id_antrian);
    }
    // return get_nomor_antrian($id_antrian);
}

function get_poli()
{
    $data = DB::table('poli')->get();

    return $data;
}
function get_poli_antrian($id_poli)
{
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date('Y-m-d');

    $data = DB::table('nomor_antrian')
        ->where('id_poli', $id_poli)
        ->where('created_at', 'like', '%' . $tanggal . '%')
        ->get();

    if (!empty($_GET['time'])) {
        $data = DB::table('nomor_antrian')
            ->where('id_poli', $id_poli)
            ->where('created_at', 'like', '%' . $_GET['time'] . '%')
            ->get();
    }

    // $id_antrian = $data[0]->id_antrian;
    if (empty($data[0]->id_antrian)) {
        return 0;
    } else {
        // dd($data);
        return $data;
    }
    // return get_nomor_antrian($id_antrian);
}

function get_kehadiran_antrian($id_poli, $status)
{
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date('Y-m-d');

    $data = DB::table('nomor_antrian')
        ->where('id_poli', $id_poli)
        ->where('created_at', 'like', '%' . $tanggal . '%')
        ->where('status_antrian', $status)
        ->get();
    // $id_antrian = $data[0]->id_antrian;
    if (!empty($_GET['time'])) {
        $data = DB::table('nomor_antrian')
            ->where('id_poli', $id_poli)
            ->where('created_at', 'like', '%' . $_GET['time'] . '%')
            ->where('status_antrian', $status)
            ->get();
    }
    if (empty($data[0]->id_antrian)) {
        return 0;
    } else {
        // dd($data);
        return count($data);
    }
    // return get_nomor_antrian($id_antrian);
}

function bilanganbulat($teks)
{
    $teks = preg_replace('/[^0-9]/', '', $teks);
    return $teks;
}

function tgl_indo($date)
{
    $BulanIndo = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $result = $tgl . ' ' . $BulanIndo[(int) $bulan - 1] . ' ' . $tahun;
    // $result = '0';
    return $result;
}

function bulan_indo($date)
{
    $BulanIndo = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $bulan = $date;
    $result = $BulanIndo[(int) $bulan - 1];
    return $result;
}

function rand_color()
{
    $background_colors = ['#6E85B7', '#898AA6', '#73A9AD', '#D96098', '#898AA6', '#CDC2AE', '#DB6400', '#3AB4F2', '#874356', '#9A86A4', '#7F8487', '#85586F', '#78938A', '#BE8C63', '#D885A3', '#1572A1', '#A267AC', '#590696', '#7C99AC', '#94B3FD', '#9D9D9D', '#7F7C82', '#F6AE99', '#B5CDA3', '#231955', '#76BA99', '#6E7582', '#BFB051', '#D8AC9C', '#676FA3', '#533535', '#1C7947', '#D57E7E', '#00C1D4', '#C15050', '#726A95'];

    $rand_background = $background_colors[array_rand($background_colors)];

    return $rand_background;
}
