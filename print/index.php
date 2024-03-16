<?php
setlocale(LC_TIME, 'id_ID'); 
include "../database.php";
echo '<script type ="text/JavaScript">';  
echo 'alert("Catatan: untuk cetak tekan klik kanan pada halaman ini kemudian pilih cetak/print, atur ukuran kerta ke Folio/F4")';  
echo '</script>';  


if (isset($_POST['nomor'])){
	$no_id = $_POST['nomor'];
	
	$nomor = mysqli_real_escape_string($db_conn, $no_id);
	$hasil = mysqli_query($db_conn, "SELECT * FROM data_sk WHERE id='$no_id'");
	if (mysqli_num_rows($hasil) > 0) {
		$data = mysqli_fetch_array($hasil);
		$nama = $data['nama'];
		$nip = $data['NIP'];
		$pangkat = $data['pangkat'];
		$kantor = $data['kantor'];
		$gaji = $data['gaji'];
		$oleh_pejabat = $data['oleh_pejabat'];
		$tanggal = $data['tanggal'];
		$tanggal_mulai = $data['tanggal_mulai'];
		$masa_kerja = $data['masa_kerja'];
		$gaji_baru = $data['gaji_baru'];
		$berdasarkan_masa_kerja = $data['berdasarkan_masa_kerja'];
		$golongan = $data['golongan'];
		$mulai_tanggal_baru = $data['mulai_tanggal_baru'];
		

	} else{
		echo('???');
	}

	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
		<meta name=Generator content="Microsoft Word 15 (filtered)">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="../img/<?= $hsl['logo'] ?>">
		<title>Cetak SKL <?=$nama;?></title>
	<style>
	
	.cap {
		visibility: visible;
		background-image: ;
		background-position: 77%;
		background-repeat: no-repeat;
		background-size: 22%;
		-webkit-print-color-adjust: exact;
		}
		.container {
      text-align: justify;
    }
	
	</style>


	</head>
	<body>

	<center>
	<table cellpadding="1" width="720px" border="0">
	<tr>
	<td>
	<div class=WordSection1>
		<center><img width=693 height=123 src="../img/kopsura.png"></center>

		<center>
			<br/>
			<u>
			<b>SURAT KETERANGAN </b></u> <br>
			Nomor : <?=$no_surat;?> <br>
		</center>
		<p>
			Perihal : Kenaikan Gaji Berkala <br><b>
	An. <?=$nama;?> </b></br>
</p>
		<p style="text-indent: 30px;">
		Dengan ini memberitahukan bahwa sehubungan dengan telah terpenuhinya masa kerja dan syarat-syarat lainnya, maka Kepada :
		</p>

		<table cellspacing="0" cellpadding="1" border="0">
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama </td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</td>
    <td><strong><?=$nama;?></strong></td>
</tr>
			
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</td>
				<td><?=$nip;?> </td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pangkat Jabatan</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</td>
				<td><?=$pangkat;?></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kantor / Instansi</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</td>
				<td><?=$kantor;?> </td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gaji Pokok lama</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</td>
				<td><b><?='Rp. ' . number_format($data['gaji'], 0, ',', '.');?> </b></td>
			</tr>
		</table>
<p style="text-indent: 30px;"> Atas Dasar Surat Keputusan terakhir tentang Gaji/pangkat yang diterima:
</p>
<table cellspacing="0" cellpadding="1" border="0">
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Oleh Pejabat </td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</td>
    <td><strong><?=$oleh_pejabat;?></strong></td>
</tr>
			
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal Mulai Berlaku Gaji Tersebut</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</td>
				<td><?=$tanggal_mulai;?></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Masa kerja Golongan Pada Tanggal Tersebut</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</td>
				<td><?=$masa_kerja;?> </td>
			</tr>
		</table>

		<center>
			<br/>
			<u>
			<b>DIBERIKAN KENAIKAN GAJI BERKALA SEHINGGA MEMPEROLEH : </b></u> 
		</center>
</br>

		<table cellspacing="0" cellpadding="1" border="0">
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gaji Pokok Baru</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</td>
    <td><strong><?='Rp. ' . number_format($gaji_baru, 0, ',', '.');?></strong></td>
</tr>
			
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berdasarkan Masa Kerja</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</td>
				<td><?=$berdasarkan_masa_kerja;?> </td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dalam Golongan ruang</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</td>
				<td><?=$golongan;?></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mulai tanggal</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;</td>
				<td><?=$mulai_tanggal_baru;?> </td>
			</tr>
		</table>
		<p class="container">Diharapkan agar sesuai dengan Peraturan Pemerintah Republik Indonesia NO : 11 tahun sekian kepada Pegawai Negeri Sipil tersebut dapat dibayarkan penghasilannya berdasarkan Gaji Pokok yang baru, dengan ketentuan bahwa pembayaran tersebut dibebankan atas Anggaran keuangan Pemerintah Daerah Kabupaten Rokan Hulu, dan jika terdapat kekeliruan dalam penetapan surat keputusan ini akan diadakan perbaikan dan perhitungan kembali sebagaimana mestinya.
				</p>


			<table class="cap">
				<tr> 
					<td width="65%"  >
						
						
					</td>
					<td width="30%" valign="top">
					Ujungbatu, <?php echo strftime('%d %B %Y'); ?> <br> Bupati Rokan hulu,
</br>
</br>
</br>
</br>
</br>
</br>

							<br>
							
							<u>
							<b><?=$bupati;?></b>
							</u>
							
					</td>
				</tr>
			</table>
		</div>
		</div>
		</td>
		</tr>
		</table>
		</center>

	</body>
	</html>


<?php 
} else{
	echo('tidak ada submit');
}

?>
