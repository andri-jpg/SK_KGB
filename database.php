<?php

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','kelulusan');

$db_conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if(mysqli_connect_errno()){
	echo 'Gagal terhubung ke database: '.mysqli_connect_error();
	exit();
}

$que = mysqli_query($db_conn, "SELECT * FROM un_konfigurasi");
$hsl = mysqli_fetch_array($que);
$timestamp = strtotime($hsl['tgl_pengumuman']);
// menghapus tags html (mencegah serangan jso pada halaman index)
$sekolah = strip_tags($hsl['sekolah']);
$bupati = strip_tags($hsl['kepsek']);
$no_surat = strip_tags($hsl['no_surat']);
$tgl_pengumuman = strip_tags($hsl['tgl_pengumuman']);
$nopesformat = strip_tags($hsl['nopesformat']);
$contact = strip_tags($hsl['contact']);
$about = strip_tags($hsl['about']);


//
// $tahun1 = $tahun-1; 
// $tahun_ajaran = $tahun1."/".$tahun;

//echo $timestamp;



// <!-- converter ke tanggal indonesia -->

$tgl = substr($tgl_pengumuman, 8, 2);
$bln = substr($tgl_pengumuman, 5, 2);
$thn = substr($tgl_pengumuman, 0, 4);
$jam = substr($tgl_pengumuman, 11, 5);
$namaBulan = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
$tgl_skl = "$tgl $namaBulan[$bln] $thn";
$waktu = "<br>$tgl $namaBulan[$bln] $thn Pukul : $jam WIB";

$tahun1 = $thn-1; 
$tahun_ajaran = $tahun1."/".$thn;

?>