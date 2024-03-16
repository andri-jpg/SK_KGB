<?php
session_start();
if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
    include "./database.php";
    include '_header.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uploadDir = "./files/";
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $pangkat = $_POST['pangkat'];
        $kantor = $_POST['kantor'];
        $gaji = $_POST['gaji'];
        $oleh_pejabat = $_POST['oleh_pejabat'];
        $tanggal = $_POST['tanggal'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $masa_kerja = $_POST['masa_kerja'];
        $gaji_baru = $_POST['gaji_baru'];
        $berdasarkan_masa_kerja = $_POST['berdasarkan_masa_kerja'];
        $golongan = $_POST['golongan'];
        $mulai_tanggal_baru = $_POST['mulai_tanggal_baru'];

        // Memeriksa apakah file berhasil diunggah
        if (isset($_FILES["tanda_terima_gaji"]) && $_FILES["tanda_terima_gaji"]["error"] == UPLOAD_ERR_OK) {
            $tandaTerimaGajiName = basename($_FILES["tanda_terima_gaji"]["name"]);
            $uploadPath = $uploadDir . $tandaTerimaGajiName;

            if (move_uploaded_file($_FILES["tanda_terima_gaji"]["tmp_name"], $uploadPath)) {
                $uploadPath = mysqli_real_escape_string($db_conn, $uploadPath);

                $query = "INSERT INTO data_sk (nama, NIP, pangkat, kantor, gaji, oleh_pejabat, tanggal, tanggal_mulai, masa_kerja, gaji_baru, berdasarkan_masa_kerja, golongan, mulai_tanggal_baru, tanda_terima_gaji) 
          VALUES ('$nama', $nip, '$pangkat', '$kantor', $gaji, '$oleh_pejabat', '$tanggal', '$tanggal_mulai', '$masa_kerja', $gaji_baru, '$berdasarkan_masa_kerja', '$golongan', '$mulai_tanggal_baru', '$uploadPath')";

                // Eksekusi query
                if (mysqli_query($db_conn, $query)) {
                    echo '<script>alert("Data berhasil diunggah.");</script>';
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($db_conn);
                }
            } else {
                echo "Gagal mengunggah file.";
            }
        } else {
            echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
        }
    }
?>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Formulir untuk pengunggahan data -->
    <div class="container mt-4">
        <h2>Unggah Data SK</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" required>
            </div>

            <div class="form-group">
                <label for="nip">NIP:</label>
                <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP" required>
            </div>

            <div class="form-group">
                <label for="pangkat">Pekerjaan:</label>
                <input type="text" class="form-control" name="pangkat" placeholder="Guru / Tata usaha?" required>
            </div>

            <div class="form-group">
                <label for="kantor">Nama Sekolah:</label>
                <input type="text" class="form-control" name="kantor" placeholder="Masukkan Nama Sekolah" required>
            </div>

            <div class="form-group">
                <label for="gaji">Gaji:</label>
                <input type="number" class="form-control" name="gaji" placeholder="Masukkan Gaji saat ini dalam rupiah" required>
            </div>

            <div class="form-group">
                <label for="oleh_pejabat">Oleh Pejabat:</label>
                <input type="text" class="form-control" name="oleh_pejabat" placeholder="Masukkan Oleh Pejabat" 
        value="<?php echo empty($_POST['oleh_pejabat']) ? 'Bupati Rokan Hulu' : htmlspecialchars($_POST['oleh_pejabat']); ?>">
</div>

            <div class="form-group">
                <label for="tanggal">Tanggal Pengajuan:</label>
                <input type="date" class="form-control" name="tanggal" placeholder="Masukkan Tanggal saat ini">
            </div>

            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai berlaku Gaji lama:</label>
                <input type="text" class="form-control" name="tanggal_mulai" placeholder="12 Desember 2023">
            </div>

            <div class="form-group">
                <label for="masa_kerja">Masa Kerja Gaji saat ini:</label>
                <input type="text" class="form-control" name="masa_kerja" placeholder="Contoh : 01 Tahun 2 Bulan">
            </div>
            
            <div class="form-group">
                <label for="gaji_baru">Gaji Baru yang di ajukan:</label>
                <input type="number" class="form-control" name="gaji_baru" placeholder="Masukkan Jumlah gaji baru dalam rupiah">
            </div>

            <div class="form-group">
                <label for="berdasarkan_masa_kerja">Masa Kerja Untuk gaji baru:</label>
                <input type="text" class="form-control" name="berdasarkan_masa_kerja" placeholder="Contoh : 01 Tahun 2 Bulan">
            </div>

            <div class="form-group">
                <label for="mulai_tanggal_baru">Tanggal mulai berlaku Gaji Baru:</label>
                <input type="text" class="form-control" name="mulai_tanggal_baru" placeholder="12 Desember 2023">
            </div>

            <div class="form-group">
                <label for="golongan">Golongan :</label>
                <input type="text" class="form-control" name="golongan" placeholder="Contoh : VII">
            </div>

            <div class="form-group">
        <label for="tanda_terima_gaji">Unggah Tanda Terima Gaji (Format jpg/png):</label>
        <input type="file" class="form-control-file" name="tanda_terima_gaji">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Unggah Data">
    </div>
</form>

    <?php
    include '_footer.php';
} else {
    header('Location: ./login.php');
}
?>
