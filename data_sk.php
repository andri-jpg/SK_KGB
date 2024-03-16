<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
	include "./database.php";
	include '_header.php';
?>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


	<div class="container">
		<h2>Data SK</h2>
		<hr>
    </div>
	<div class="row">
		<div class="container">
			<!-- input Cari data -->
			<form action="sudah_ambil.php" method="get">
				<div class="control-label ">
					<input type="text" name="cari" class="col-sm-3 " style="height:43px"> &nbsp;
					<input type="submit" class="btn btn-primary" value=" Cari">
				</div>
			</form>
			
<br>
			<!-- Wilayah Tabel -->
			<div class="table table-responsive wrapper">

				<table class="table table-bordered table-hover table-striped table-fixed header-fixed table-fixed head">
					<thead>
						<tr class="">
							<th rowspan="2" style=" min-width:40px; vertical-align: middle; text-align: center;">
								No.
							</th>
							<th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
							<a href=" <?php $_SERVER['PHP_SELF'] ?>?by=namaasc"><span class="fa fa-arrow-up"></span></a>
								Nama
								<a href="<?php $_SERVER['PHP_SELF'] ?>?by=namadesc"><span class="fa fa-arrow-down"></span></a>
							</th>

							<th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
								NIP
							</th>

							<th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
								Pekerjaan
							</th>

							
							<th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
								Instansi
							</th>

							<th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
								Gaji Lama
							</th>

							<th rowspan="2" style=" min-width:120px; vertical-align: middle; text-align: center;">
								Gaji Baru
							</th>

							<th rowspan="2" style=" min-width:130px; vertical-align: middle; text-align: center;">
								Tanggal Pengajuan
							</th>
							<th rowspan="2" style=" min-width:130px; vertical-align: middle; text-align: center;">
								Golongan
							</th>

							</th>
							<th rowspan="2" style="min-width:120px; vertical-align: middle; text-align: center;">
    Aksi
</th>

					</thead>
					<tbody>
						<?php
						//cari
						if (isset($_GET['cari'])) {
							$cari = addslashes($_GET['cari']);
							$qdata_sk = mysqli_query($db_conn, "SELECT * FROM data_sk WHERE nama like '%" . $cari . "%' OR NIP like '%" . $cari . "%' OR pangkat like '%" . $cari . "%' ORDER BY id ASC");
						} else if (isset($_GET['by'])) {
							$sort = $_GET['by'];
							switch ($sort) {
								case 'idasc':
									$qdata_sk = mysqli_query($db_conn, "SELECT * FROM data_sk ORDER BY id ASC");
									break;
								case 'iddesc':
									$qdata_sk = mysqli_query($db_conn, "SELECT * FROM data_sk ORDER BY id DESC");
									break;
								case 'namaasc':
									$qdata_sk = mysqli_query($db_conn, "SELECT * FROM data_sk ORDER BY nama ASC");
									break;
								case 'namadesc':
									$qdata_sk = mysqli_query($db_conn, "SELECT * FROM data_sk ORDER BY nama DESC");
									break;
								case 'nipasc':
									$qdata_sk = mysqli_query($db_conn, "SELECT * FROM data_sk ORDER BY NIP ASC");
									break;
								case 'nipdesc':
									$qdata_sk = mysqli_query($db_conn, "SELECT * FROM data_sk ORDER BY NIP DESC");
									break;
								case 'pangkatasc':
									$qdata_sk = mysqli_query($db_conn, "SELECT * FROM data_sk ORDER BY pangkat ASC");
									break;
								case 'pangkatdesc':
									$qdata_sk = mysqli_query($db_conn, "SELECT * FROM data_sk ORDER BY pangkat DESC");
									break;
								default:
									$qdata_sk = mysqli_query($db_conn, "SELECT * FROM data_sk");
									break;
							}
						} else {
							$qdata_sk = mysqli_query($db_conn, "SELECT * FROM data_sk");
						}
						$no = 1; 
						if (mysqli_num_rows($qdata_sk) > 0) {
							while ($data = mysqli_fetch_array($qdata_sk)) {
								echo '<tr>';
								echo '<td class="text-center">' . $no++ . '</td>';
								echo '<td>' . $data['nama'] . '</td>';
								echo '<td>' . $data['NIP'] . '</td>';
								echo '<td>' . $data['pangkat'] . '</td>';
								echo '<td>' . $data['kantor'] . '</td>';
								echo '<td>Rp. ' . number_format($data['gaji'], 0, ',', '.') . '</td>';
								echo '<td>Rp. ' . number_format($data['gaji_baru'], 0, ',', '.') . '</td>';
								echo '<td>' . $data['tanggal'] . '</td>';
								echo '<td>' . $data['golongan'] . '</td>';						
								echo '<td class="text-center">';
								echo '<form method="post" action="./detail_sk.php">';
								echo '<input type="hidden" name="nomor" value="' . $data['id'] . '">';
								echo '<button type="submit" class="btn btn-warning btn-sm">Detail</button>';
								echo '</form>';
								echo '</td>';							
								echo '</tr>';

								
							}
						} else {
							echo '<tr><td colspan="8"><em>Tidak ada data yang bisa di tampilkan !</em></td></tr>';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
					</div>



	<?php
} else {
	header('Location: ./login.php');
}
	?>