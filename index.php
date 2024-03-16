<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
	include "./database.php";
	include '_header.php';

?>

	<div class="container">
		<?php
		//tempatkan di sini halaman administrator
		if (isset($_REQUEST['hlm'])) {
			$hlm = $_REQUEST['hlm'];

			switch ($hlm) {
				case 'user':
					include 'user.php';
					break;
				case 'data':
					include 'data.php';
			}
		} else {
		?>
			<div class="jumbotron">
				<div class="container">
					<h2><b>Halo, administrator!</b></h2>
					<p>Ini merupakan halaman administrasi untuk pengumuman <strong>Info Kelulusan <?= $thn ?></strong>.</p>
					<p>Fasilitas yang tersedia saat ini adalah manajemen <strong>User</strong> yang diberi hak untuk mengelola aplikasi ini dan import <strong>Data</strong></p>
				</div>
			</div>

		<?php
		}
		?>
	</div><!-- /.container -->


<?php

	include '_footer.php';
} else {
	header('Location: ./login.php');
}
?>